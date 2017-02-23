import { Component, OnInit } from '@angular/core';
import { Categories } from './categories';
import { CategoriesService } from './categories.service';

@Component({
  selector: '[category-sidebar]',
  templateUrl: './categories.component.html',
  styleUrls: ['./categories.component.css'],
  providers: [CategoriesService]
})


export class BlogCategoriesComponent implements OnInit {

  categories: Categories[];

  constructor( private categoriesService: CategoriesService ) {
    this.categoriesService = categoriesService;
  }

  getCategories(){
    this.categoriesService
      .getCategories()
      .subscribe(res => {
        this.categories = res;
      });
  }

  ngOnInit() {
    this.getCategories();
  }

}
