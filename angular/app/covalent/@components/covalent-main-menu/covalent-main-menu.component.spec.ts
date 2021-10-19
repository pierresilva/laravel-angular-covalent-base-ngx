import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CovalentMainMenuComponent } from './covalent-main-menu.component';

describe('CovalentMainMenuComponent', () => {
  let component: CovalentMainMenuComponent;
  let fixture: ComponentFixture<CovalentMainMenuComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CovalentMainMenuComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CovalentMainMenuComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
