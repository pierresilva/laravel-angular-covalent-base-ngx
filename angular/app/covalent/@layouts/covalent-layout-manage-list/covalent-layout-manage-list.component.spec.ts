import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CovalentLayoutManageListComponent } from './covalent-layout-manage-list.component';

describe('CovalentLayoutManageListComponent', () => {
  let component: CovalentLayoutManageListComponent;
  let fixture: ComponentFixture<CovalentLayoutManageListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CovalentLayoutManageListComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CovalentLayoutManageListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
