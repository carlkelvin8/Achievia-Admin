@props([
  'name',
  'value' => '',
  'label' => null,
  'placeholder' => '',
  'required' => false,
])

<div class="w-full">
  @if($label)
    <label class="block text-sm font-semibold text-gray-700 mb-1" for="{{ $name }}">
      {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
  @endif

  <textarea
    id="{{ $name }}"
    name="{{ $name }}"
    class="rte w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none min-h-[140px]"
    placeholder="{{ $placeholder }}"
  >{!! old($name, $value) !!}</textarea>

  @error($name)
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
  @enderror
</div>

@once
  @push('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        tinymce.init({
          selector: 'textarea.rte',
          menubar: false,
          branding: false,
          statusbar: false,
          plugins: 'link lists code',
          toolbar: 'undo redo | bold italic underline | subscript superscript | bullist numlist | link | code',
          toolbar_mode: 'sliding',
          link_target_list: [
            { title: 'New tab', value: '_blank' },
            { title: 'None', value: '' }
          ],
          block_unsupported_drop: true,
          convert_urls: false,
          valid_elements: 'p,br,span,em/i,strong/b,u,sub,sup,small,ul,ol,li,a[href|title|target],blockquote,code',
          content_style: 'body{font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;font-size:14px;line-height:1.6;} sub{font-size:0.8em;} sup{font-size:0.8em;}',
        });
      });
    </script>
  @endpush
@endonce
