import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

import { Observable } from 'rxjs/Observable';

import 'rxjs/add/operator/map';

import { Categories } from './categories';

@Injectable()

export class CategoriesService {

  private categoriesUrl = location.protocol + "//" + location.hostname + "/index.php/wp-json/wp/v2/";

  constructor(private http: Http) { }

  getCategories(): Observable<Categories[]> {

      return this.http
        .get(this.categoriesUrl + 'categories')
        .map((res: Response) => res.json());

  }
  getCategory(id: number): Observable<Categories> {

    return this.http
      .get(this.categoriesUrl + 'categories/' + id)
      .map((res: Response) => res.json());

  }
}
