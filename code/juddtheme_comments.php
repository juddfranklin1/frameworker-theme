<?php

/**
 * A hack at class overwriting the Comments Walker
 */


// Exit if accessed directly
defined( 'ABSPATH' ) || exit;


if ( ! class_exists( 'Juddtheme_Comments_Walker' ) ) :

class Juddtheme_Comments_Walker extends Walker_Comment {

    /**
     * @see Walker::start_el()
     * @see wp_list_comments()
     */
    public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 )
    {

        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;

        if ( !empty( $args['callback'] ) ) {
            ob_start();
            call_user_func( $args['callback'], $comment, $args, $depth );
            $output .= ob_get_clean();
            return;
        }

        if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping'] ) {
            ob_start();
            $this->ping( $comment, $depth, $args );
            $output .= ob_get_clean();
        } elseif ( 'html5' === $args['format'] ) {
            ob_start();
            if ( !empty( $args['has_children'] ) ) {
                $this->start_parent_html5_comment( $comment, $depth, $args );
            } else {
                $this->html5_comment( $comment, $depth, $args );
            }
            $output .= ob_get_clean();
        } else {
            ob_start();
            $this->comment( $comment, $depth, $args );
            $output .= ob_get_clean();
        }
    }


    /**
     * Ends the element output, if needed.
     *
     * This ends the comment.  Will check if the comment has children or is a stand-alone comment.
     *
     * @access public
     * @since 0.1.0
     *
     * @see Walker::end_el()
     * @see wp_list_comments()
     *
     * @param string     $output  Passed by reference. Used to append additional content.
     * @param WP_Comment $comment The comment object. Default current comment.
     * @param int        $depth   Depth of comment.
     * @param array      $args    An array of arguments.
     */
    public function end_el( &$output, $comment, $depth = 0, $args = array() )
    {
        if ( !empty( $args['end-callback'] ) ) {
            ob_start();
            call_user_func( $args['end-callback'], $comment, $args, $depth );
            $output .= ob_get_clean();
            return;
        }

        if ( !empty( $args['has_children'] ) && 'html5' === $args['format']) {
            ob_start();
            $this->end_parent_html5_comment( $comment, $depth, $args );
            $output .= ob_get_clean();
        } else {
            if ( 'div' == $args['style'] ) {
                $output .= "</div><!-- #comment-## -->\n";
            } else {
                $output .= "</li><!-- #comment-## -->\n";
            }
        }
    }


    /**
     * Output the beginning of a parent comment in the HTML5 format.
     *
     * @param object $comment Comment to display.
     * @param int    $depth   Depth of comment.
     * @param array  $args    An array of arguments.
     */
    protected function start_parent_html5_comment( $comment, $depth, $args )
    {
        $this->html5_comment( $comment, $depth, $args, $is_parent = true );
    }


    /**
     * Output a comment in the HTML5 format.
     *
     * @access protected
     * @since 0.1.0
     *
     * @see wp_list_comments()
     *
     * @param object  $comment   Comment to display.
     * @param int     $depth     Depth of comment.
     * @param array   $args      An array of arguments.
     * @param boolean $is_parent Flag indicating whether or not this is a parent comment
     */
    protected function html5_comment( $comment, $depth, $args, $is_parent = false )
    {

        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

        $type = get_comment_type();

        $comment_classes = array();
        $comment_classes[] = 'card';

        // if it's a parent
        if ( $this->has_children ) {
            $comment_classes[] = 'parent';
            $comment_classes[] = 'has-children';
        }

        // if it's a child
        if ( $comment->comment_parent > 0 ) {
            $comment_classes[] = 'child';
            $comment_classes[] = 'has-parent';
            $comment_classes[] = 'parent-' . $comment->comment_parent;
        }

        $comment_classes = apply_filters( 'Juddtheme_Comments_Walker_class', $comment_classes, $comment, $depth, $args );

        $class_str = implode(' ', $comment_classes);

?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $class_str, $comment ); ?>>

            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

                <?php if ( 0 != $args['avatar_size'] && 'pingback' !== $type && 'trackback' !== $type ) { ?>
                    <div class="media-left">
                        <?php echo $this->get_comment_author_avatar( $comment, $args ); ?>
                    </div>
                <?php }; ?>

                <div class="media-body">

                    <footer class="comment-meta">
                        <div class="comment-author vcard">
                            <?php printf( __( '%s <span class="says sr-only">says:</span>' ), sprintf( '<b class="media-heading fn">%s</b>', get_comment_author_link( $comment ) ) ); ?>
                        </div><!-- /.comment-author -->

                        <div class="comment-metadata">
                            <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                                <time datetime="<?php comment_time( 'c' ); ?>">
                                    <?php
                                    /* translators: 1: comment date, 2: comment time */
                                    printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
                                    ?>
                                </time>
                            </a>
                            <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link btn btn-default pull-right">', '</span>' ); ?>
                        </div><!-- /.comment-metadata -->

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
                        <?php endif; ?>
                    </footer><!-- /.comment-meta -->

                    <div class="comment-content">
                        <?php comment_text(); ?>
                    </div><!-- /.comment-content -->

                    <?php $this->comment_reply_link( $comment, $depth, $args, $add_below = 'reply-comment' ); ?>

                    <?php if ( $is_parent ) { ?>
                        <div class="child-comments">
                    <?php } else { ?>
                            </div><!-- /.media-body -->
                        </article><!-- /.comment-body -->
                    <?php } ?>

<?php
    }

    protected function end_parent_html5_comment( $comment, $depth, $args )
    {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
                    </div><!-- /.child-comments -->
                </div><!-- /.media-body -->
            </article><!-- /.comment-body -->
        </<?php echo $tag; ?>><!-- /.parent -->

<?php
    }

    protected function ping( $comment, $depth, $args ) {

        $tag = ( 'div' == $args['style'] ) ? 'div' : 'li';

        $comment_classes = array();
        $comment_classes[] = 'card';

        $comment_classes = apply_filters( 'wp_bootstrap_comment_class', $comment_classes, $comment, $depth, $args );

        $class_str = implode(' ', $comment_classes);
?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $class_str, $comment ); ?>>
            <div class="card-block">
                <div class="card-subtitle">
                    <?php _e( 'Pingback:' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- /.card-block -->
            </div><!-- /.comment-body -->
<?php
    }

    protected function get_comment_author_avatar( $comment, $args )
    {
        $avatar_string = get_avatar( $comment, $args['avatar_size'] );
        $comment_author_url = get_comment_author_url( $comment );

        if ( '' !== $comment_author_url ) {
            $avatar_string = sprintf(
                '<a href="%1$s" class="author-link url" rel="external nofollow">%2$s</a>',
                esc_url($comment_author_url),
                $avatar_string
            );
        };

        return $avatar_string;
    }

    protected function comment_reply_link( $comment, $depth, $args, $add_below = 'div-comment' )
    {
        $type = get_comment_type();

        if ( 'pingback' === $type || 'trackback' === $type ) {
            return;
        }

        comment_reply_link( array_merge( $args, array(
            'add_below' => $add_below,
            'depth'     => $depth,
            'max_depth' => $args['max_depth'],
            'before'    => '<div id="reply-comment-'.$comment->comment_ID.'" class="reply btn btn-default">',
            'after'     => '</div>'
        ) ) );
    }

}

endif;
