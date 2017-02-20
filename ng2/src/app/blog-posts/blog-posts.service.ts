import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

import { Observable } from 'rxjs/Observable';

import 'rxjs/add/operator/map';

import { BlogPost } from './blog-post';

@Injectable()

export class BlogPostsService {

  private blogPostsUrl = location.protocol + "//" + location.hostname + "/index.php/wp-json/wp/v2/";

  constructor(private http: Http) { }

  getBlogPosts(): Observable<BlogPost[]> {

      return this.http
        .get(this.blogPostsUrl + 'posts')
        .map((res: Response) => res.json());

  }
  getBlogPost(id: number): Observable<BlogPost> {

      return this.http
        .get(this.blogPostsUrl + 'posts/' + id)
        .map((res: Response) => res.json());

  }
}
