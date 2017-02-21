import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { BlogPost } from '../blog-post';
import { BlogPostsService } from '../blog-posts.service'

@Component({
  selector: 'app-post-single',
  templateUrl: './blog-post-single.component.html',
  styleUrls: ['./blog-post-single.component.css'],
  providers: [BlogPostsService]
})

export class BlogPostSingleComponent implements OnInit {
  id: number;
  private sub: any;
  blogPost: BlogPost;

  constructor( private BlogPostsService: BlogPostsService, private route: ActivatedRoute ) {  }

  getBlogPost(postId){
    this.BlogPostsService
      .getBlogPost(postId)
      .subscribe(res => {
        this.blogPost = res;
      });
  }

  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
       this.id = +params['id']; // (+) converts string 'id' to a number

       this.getBlogPost(this.id);
    });
  }

}
