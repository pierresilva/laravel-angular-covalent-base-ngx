import {Directive, forwardRef, Input, SimpleChanges} from '@angular/core';
import {AbstractControl, NG_VALIDATORS, ValidationErrors, ValidatorFn, Validators} from "@angular/forms";
import {isPresent} from "@shared/directives/lang";

export const arrayLength = (value: number): ValidatorFn => {
  return (control: AbstractControl): ValidationErrors | any => {

    if (isPresent(Validators.required(control))) {
      return null;
    }

    const obj = control.value;
    return Array.isArray(obj) && obj.length >= +value ? null : {arrayLength: {minLength: value}};
  };
};

const ARRAY_LENGTH_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateArrayLengthDirective),
  multi: true
};

@Directive({
  selector: '[arrayLength][formControlName],[arrayLength][formControl],[arrayLength][ngModel]',
  providers: [ARRAY_LENGTH_VALIDATOR]
})
export class ValidateArrayLengthDirective {

  @Input() arrayLength: number | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = arrayLength(this.arrayLength);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (const key in changes) {
      if (key === 'arrayLength') {
        this.validator = arrayLength(changes[key].currentValue);
        if (this.onChange) {
          this.onChange();
        }
      }
    }
  }

  validate(c: AbstractControl): { [key: string]: any } {
    return this.validator(c);
  }

  registerOnValidatorChange(fn: () => void): void {
    this.onChange = fn;
  }

}
