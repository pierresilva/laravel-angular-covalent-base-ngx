import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-about-form',
  templateUrl: './about-form.component.html',
  styleUrls: ['./about-form.component.scss']
})
export class AboutFormComponent implements OnInit {

  objects: any[] = [
    { id: 1, city: 'San Diego', population: '4M' },
    { id: 2, city: 'San Franscisco', population: '6M' },
    { id: 3, city: 'Los Angeles', population: '5M' },
    { id: 4, city: 'Austin', population: '3M' },
    { id: 5, city: 'New York City', population: '10M' },
  ];

  filteredObjects: string[] = [];

  objectsModel: string[] = this.objects.slice(0, 2);

  files: any;

  value: any;

  constructor() { }

  ngOnInit(): void {
    this.filterObjects('');
  }

  filterObjects(value: string): void {
    this.filteredObjects = this.objects
      .filter((obj: any) => {
        if (value) {
          return obj.city.toLowerCase().indexOf(value.toLowerCase()) > -1;
        } else {
          return false;
        }
      })
      .filter((filteredObj: any) => {
        return this.objectsModel ? this.objectsModel.indexOf(filteredObj) < 0 : true;
      });
  }

}
