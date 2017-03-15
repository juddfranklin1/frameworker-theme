import { Component, OnInit, Input } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { BlogPostListComponent } from '../blog-post-list/blog-post-list.component';
import { FavoriteComponent } from '../../shared/favorite/favorite.component';

@Component({
  selector: 'blog-post-listing',
  templateUrl: './blog-post-listing.component.html',
  styleUrls: ['./blog-post-listing.component.css']
})
export class BlogPostListingComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }
  @Input() blogPost:BlogPostListComponent;

}
