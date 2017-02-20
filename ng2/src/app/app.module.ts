import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';
import { BlogPostListComponent } from './blog-posts/blog-post-list/blog-post-list.component';
import { BlogPostSingleComponent } from './blog-posts/blog-post-single/blog-post-single.component';
import { Wpng2RoutingModule } from './app-routing.module';
import { CategoriesComponent } from './categories/categories.component';

@NgModule({
  declarations: [
    AppComponent,
    BlogPostListComponent,
    BlogPostSingleComponent,
    CategoriesComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    Wpng2RoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
