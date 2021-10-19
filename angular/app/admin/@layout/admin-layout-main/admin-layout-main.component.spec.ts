import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AdminLayoutMainComponent } from './admin-layout-main.component';

describe('AdminLayoutMainComponent', () => {
  let component: AdminLayoutMainComponent;
  let fixture: ComponentFixture<AdminLayoutMainComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AdminLayoutMainComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AdminLayoutMainComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
