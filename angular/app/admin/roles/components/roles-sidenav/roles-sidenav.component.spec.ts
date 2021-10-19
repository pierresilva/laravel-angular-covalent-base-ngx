import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RolesSidenavComponent } from './roles-sidenav.component';

describe('RolesSidenavComponent', () => {
  let component: RolesSidenavComponent;
  let fixture: ComponentFixture<RolesSidenavComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ RolesSidenavComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(RolesSidenavComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
