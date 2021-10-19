import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BookListAltComponent } from './book-list-alt.component';

describe('BookListAltComponent', () => {
  let component: BookListAltComponent;
  let fixture: ComponentFixture<BookListAltComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BookListAltComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(BookListAltComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
