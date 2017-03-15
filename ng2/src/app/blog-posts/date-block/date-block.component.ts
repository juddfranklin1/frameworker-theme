import { Component, OnInit, Input } from '@angular/core';

import { BlogPostListComponent } from '../blog-post-list/blog-post-list.component';

@Component({
  selector: '[date-block]',
  templateUrl: './date-block.component.html',
  styleUrls: ['./date-block.component.css']
})
export class DateBlockComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

  @Input() blogPost:BlogPostListComponent;

}
