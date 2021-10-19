import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ErrorHandlerDialogComponent } from './error-handler-dialog.component';

describe('ErrorHandlerDialogComponent', () => {
  let component: ErrorHandlerDialogComponent;
  let fixture: ComponentFixture<ErrorHandlerDialogComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ErrorHandlerDialogComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ErrorHandlerDialogComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
