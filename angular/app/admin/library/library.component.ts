import { Component, OnInit } from '@angular/core';
import {LibraryLayoutService} from "@app/admin/library/@libary-layout/services/library-layout.service";

@Component({
  selector: 'app-library',
  templateUrl: './library.component.html',
  styleUrls: ['./library.component.scss']
})
export class LibraryComponent implements OnInit {

  constructor(
    public layoutService: LibraryLayoutService
  ) { }

  ngOnInit(): void {
  }

}
