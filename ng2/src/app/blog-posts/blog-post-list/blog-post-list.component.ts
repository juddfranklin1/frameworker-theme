import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { BlogPost } from '../blog-post';
import { BlogPostsService } from '../blog-posts.service';

@Component({
  selector: 'app-post-list',
  templateUrl: './blog-post-list.component.html',
  styleUrls: ['./blog-post-list.component.css'],
  providers: [BlogPostsService]
})

export class BlogPostListComponent implements OnInit {
  categoryId: number;
  private sub: any;
  blogPosts: BlogPost[];

  constructor( private BlogPostsService: BlogPostsService, private route: ActivatedRoute ) {  }

  getBlogPosts(queryType,categoryId,filterText){
    let queryString = queryType || '';
    let uniqueId = categoryId || '';
    let filterString = filterText || '';
    this.BlogPostsService
      .getBlogPosts(queryType,uniqueId,filterString)
      .subscribe(res => {
        this.blogPosts = res;
      });
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
