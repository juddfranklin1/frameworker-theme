import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { BlogPostListingComponent } from './blog-posts/blog-post-listing/blog-post-listing.component';
import { BlogPostListComponent } from './blog-posts/blog-post-list/blog-post-list.component';
import { BlogPostSingleComponent } from './blog-posts/blog-post-single/blog-post-single.component';

const routes: Routes = [
  {
    path: '',
    component: BlogPostListComponent,
    pathMatch: 'full'
  },
  {
    path: 'posts/:id',
    component: BlogPostSingleComponent
  },
  {
    path: 'categories/:categoryId',
    component: BlogPostListComponent,
    pathMatch: 'full'
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
  providers: []
})
export class BlogRoutingModule { }
