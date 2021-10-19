import {Component, OnInit, ViewChild} from '@angular/core';
import {CovalentLayoutService} from "@app/covalent/@layouts/services/covalent-layout.service";
import {CovalentAuthosListComponent} from "@app/covalent/covalent-authors/components/covalent-authos-list/covalent-authos-list.component";
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'app-covalent-authors-sidenav',
  templateUrl: './covalent-authors-sidenav.component.html',
  styleUrls: ['./covalent-authors-sidenav.component.scss']
})
export class CovalentAuthorsSidenavComponent implements OnInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public layoutService: CovalentLayoutService,
    public authorsListComponent: CovalentAuthosListComponent,
  ) { }

  ngOnInit(): void {

  }

}
