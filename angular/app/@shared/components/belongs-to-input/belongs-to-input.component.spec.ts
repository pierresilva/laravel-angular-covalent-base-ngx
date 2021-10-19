import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BelongsToInputComponent } from './belongs-to-input.component';

describe('BelongsToInputComponent', () => {
  let component: BelongsToInputComponent;
  let fixture: ComponentFixture<BelongsToInputComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BelongsToInputComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(BelongsToInputComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
