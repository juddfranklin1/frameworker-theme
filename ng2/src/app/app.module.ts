import { BrowserModule } from '@angular/platform-browser';
import { Component, NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';
import { BlogPostListComponent } from './blog-posts/blog-post-list/blog-post-list.component';
import { BlogPostSingleComponent } from './blog-posts/blog-post-single/blog-post-single.component';
import { BlogRoutingModule } from './app-routing.module';
import { BlogCategoriesComponent } from './categories/categories.component';
import { PageLoaderComponent } from './page-loader/page-loader.component';
import { DateBlockComponent } from './blog-posts/date-block/date-block.component';
import { BlogPostListingComponent } from './blog-posts/blog-post-listing/blog-post-listing.component';
import { FavoriteComponent } from './shared/favorite/favorite.component';

@NgModule({
  declarations: [
    AppComponent,
    BlogPostListComponent,
    BlogPostSingleComponent,
    BlogCategoriesComponent,
    PageLoaderComponent,
    DateBlockComponent,
    BlogPostListingComponent,
    FavoriteComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    BlogRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
