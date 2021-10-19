import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BelongsToManyInputComponent } from './belongs-to-many-input.component';

describe('BelongsToManyInputComponent', () => {
  let component: BelongsToManyInputComponent;
  let fixture: ComponentFixture<BelongsToManyInputComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BelongsToManyInputComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(BelongsToManyInputComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
