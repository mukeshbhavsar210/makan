<div class="rhea_prop_search__option rhea_prop_search__select rhea_types_field rhea-ultra-field-separator" data-key-position="3" id="type-27a00c8" style="order: 3">
    <span class="rhea_prop_search__selectwrap ">
         <select name="category" id="category" class="rhea_multi_select_picker show-tick">
            <option value="">Category</option>
            @if ($categories)
                  @foreach ($categories as $category)
                     <option {{ (Request::get('category') == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
            @endif
         </select>
    </span>
 </div>