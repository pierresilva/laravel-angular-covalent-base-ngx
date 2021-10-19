import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { GenresRoutingModule } from './genres-routing.module';
import { GenresListComponent } from './components/genres-list/genres-list.component';
import { GenresFormComponent } from './components/genres-form/genres-form.component';
import { GenresSidenavComponent } from './components/genres-sidenav/genres-sidenav.component';
import { GenresComponent } from './genres.component';
import { SharedModule } from "@shared";


@NgModule({
  declarations: [
    GenresListComponent,
    GenresFormComponent,
    GenresSidenavComponent,
    GenresComponent,
  ],
  imports: [
    CommonModule,
    SharedModule,
    GenresRoutingModule
  ]
})
export class GenresModule { }
