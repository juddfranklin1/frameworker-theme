import { Component, OnInit, Output } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { BlogPost } from '../blog-post';
import { BlogPostListingComponent } from '../blog-post-listing/blog-post-listing.component';

import { PageLoaderComponent } from '../../page-loader/page-loader.component';

import { WordpressService } from '../../wordpress.service';
import { BlogPostsService } from '../blog-posts.service';

@Component({
  selector: 'app-post-list',
  templateUrl: './blog-post-list.component.html',
  styleUrls: ['./blog-post-list.component.css'],
  providers: [BlogPostsService, WordpressService]
})

export class BlogPostListComponent implements OnInit {
  appLoaded: string = 'unloaded';
  categoryId: number;
  private sub: any;
  blogPosts: BlogPost[];
  loaderHide: boolean = false;
  errorFound: string;

  constructor(
    private BlogPostsService: BlogPostsService,
    private WordpressService: WordpressService,
    private route: ActivatedRoute ) { }

  getBlogPosts(queryType,categoryId,filterText){
    let queryString = queryType || '';
    let uniqueId = categoryId || '';
    let filterString = filterText || '';
    this.BlogPostsService
      .getBlogPosts(queryType,uniqueId,filterString)
      .subscribe(
        (data) => {
          this.blogPosts = data;
          this.appLoaded = 'loaded';
          setTimeout(() => this.loaderHide = true, 2000);
        },
        (err) => {
          let emptyList : BlogPost[] = [];
          this.blogPosts = emptyList;
          this.errorFound = "We're sorry, but there was an error recieving your request.";
          console.log(err);
          this.appLoaded = 'loaded';
          setTimeout(() => this.loaderHide = true, 2000);
        }
      );
  }

  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
       this.categoryId = +params['categoryId'] || null; // (+) converts string 'id' to a number
       if (this.categoryId === null){
          this.getBlogPosts('posts','','');
       } else {
         this.getBlogPosts('categories',this.categoryId,'');
       }
    });
  }

}
