import { Component, OnInit } from '@angular/core';
import {Shell} from "@app/shell/shell.service";

@Component({
  selector: 'app-shell-menu',
  templateUrl: './shell-menu.component.html',
  styleUrls: ['./shell-menu.component.scss']
})
export class ShellMenuComponent implements OnInit {

  constructor(
    public shellService: Shell,
  ) { }

  ngOnInit(): void {
  }

}
