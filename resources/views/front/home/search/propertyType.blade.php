<div class="rhea_prop_search__option rhea_prop_search__select rhea_types_field rhea-ultra-field-separator" data-key-position="4" id="type-7aa80cab" style="order: 4">
    <span class="rhea_prop_search__selectwrap ">
        <select name="type[]" id="select-type-7aa80cab"
            class="rhea_multi_select_picker show-tick"
            data-selected-text-format="count > 2"
            data-live-search="true" data-size="5.5"
            data-actions-box="true" title="All Types"
            data-count-selected-text="{0} Types Selected">

            <option value="any" selected="selected">All Types</option>
            @if($newCategories->isNotEmpty())
                @foreach ($newCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            @endif            
        </select>
    </span>
</div>