import { Component, OnInit } from '@angular/core';
import { BlogPost } from '../blog-post';
import { BlogPostsService } from '../blog-posts.service';

@Component({
  selector: 'app-post-list',
  templateUrl: './blog-post-list.component.html',
  styleUrls: ['./blog-post-list.component.css'],
  providers: [BlogPostsService]
})

export class BlogPostListComponent implements OnInit {

  blogPosts: BlogPost[];

  constructor( private BlogPostsService: BlogPostsService ) {  }

  getBlogPosts(){
    this.BlogPostsService
      .getBlogPosts()
      .subscribe(res => {
        this.blogPosts = res;
      });
  }

  ngOnInit() {
    this.getBlogPosts();
  }

}
