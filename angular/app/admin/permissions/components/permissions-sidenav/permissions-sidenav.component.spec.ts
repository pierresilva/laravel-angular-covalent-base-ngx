import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PermissionsSidenavComponent } from './permissions-sidenav.component';

describe('PermissionsSidenavComponent', () => {
  let component: PermissionsSidenavComponent;
  let fixture: ComponentFixture<PermissionsSidenavComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PermissionsSidenavComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(PermissionsSidenavComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
