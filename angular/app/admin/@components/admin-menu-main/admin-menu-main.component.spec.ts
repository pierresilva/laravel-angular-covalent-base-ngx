import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AdminMenuMainComponent } from './admin-menu-main.component';

describe('AdminMenuMainComponent', () => {
  let component: AdminMenuMainComponent;
  let fixture: ComponentFixture<AdminMenuMainComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AdminMenuMainComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AdminMenuMainComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
