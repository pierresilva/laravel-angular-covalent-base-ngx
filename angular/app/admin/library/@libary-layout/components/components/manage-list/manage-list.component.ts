import { Component, OnInit } from '@angular/core';
import {LibraryLayoutService} from "@app/admin/library/@libary-layout/services/library-layout.service";

@Component({
  selector: 'app-manage-list',
  templateUrl: './manage-list.component.html',
  styleUrls: ['./manage-list.component.scss']
})
export class ManageListComponent implements OnInit {

  constructor(
    public layoutService: LibraryLayoutService
  ) { }

  ngOnInit(): void {
  }

}
