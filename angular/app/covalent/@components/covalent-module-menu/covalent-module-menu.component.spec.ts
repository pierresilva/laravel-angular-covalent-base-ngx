import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CovalentModuleMenuComponent } from './covalent-module-menu.component';

describe('CovalentModuleMenuComponent', () => {
  let component: CovalentModuleMenuComponent;
  let fixture: ComponentFixture<CovalentModuleMenuComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CovalentModuleMenuComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CovalentModuleMenuComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
