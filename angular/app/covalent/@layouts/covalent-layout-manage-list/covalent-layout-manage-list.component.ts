import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {TdLayoutComponent, TdLayoutManageListComponent} from "@covalent/core/layout";
import { tdRotateAnimation } from '@covalent/core/common';
import {TdMediaService} from "@covalent/core/media";
import {CovalentLayoutService} from "@app/covalent/@layouts/services/covalent-layout.service";

@Component({
  selector: 'app-covalent-layout-manage-list',
  templateUrl: './covalent-layout-manage-list.component.html',
  styleUrls: ['./covalent-layout-manage-list.component.scss'],
  animations: [
    tdRotateAnimation,
  ],
})
export class CovalentLayoutManageListComponent implements OnInit, AfterViewInit {

  @ViewChild('manageList') manageList: TdLayoutManageListComponent | any;
  @ViewChild('tdLayout') tdLayout: TdLayoutComponent | any;

  year: string = new Date().getFullYear().toString();

  constructor(
    public layoutService: CovalentLayoutService,
  ) { }

  ngOnInit(): void {
  }

  ngAfterViewInit() {
    this.layoutService.tdLayout = this.tdLayout;
    this.layoutService.manageList = this.manageList;
  }

}
