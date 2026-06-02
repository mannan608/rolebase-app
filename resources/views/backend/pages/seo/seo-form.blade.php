 @php
     use Illuminate\Support\Facades\Storage;

     $seo = $seo ?? null;

     $headerScripts = old('header_scripts', $seo?->header_scripts ?? ['']);
     $headerScripts = is_array($headerScripts) ? $headerScripts : [''];
     $headerScripts = $headerScripts === [] ? [''] : $headerScripts;

     $footerScripts = old('footer_scripts', $seo?->footer_scripts ?? ['']);
     $footerScripts = is_array($footerScripts) ? $footerScripts : [''];
     $footerScripts = $footerScripts === [] ? [''] : $footerScripts;

     $ogImage = old('og_image') ? null : ($seo?->og_image ?? null);
     $ogImageUrl = null;
     if ($ogImage) {
         $ogImageUrl = Storage::disk('public')->exists($ogImage) ? Storage::disk('public')->url($ogImage) : asset($ogImage);
     }

     $twitterImage = old('twitter_image') ? null : ($seo?->twitter_image ?? null);
     $twitterImageUrl = null;
     if ($twitterImage) {
         $twitterImageUrl = Storage::disk('public')->exists($twitterImage) ? Storage::disk('public')->url($twitterImage) : asset($twitterImage);
     }
 @endphp

 <div class="space-y-3">
     <div class="rounded-xl border border-gray-200 dark:border-gray-800 p-5 bg-white dark:bg-gray-900 px-5 py-4 mb-4">
         <h3 class="text-lg font-semibold dark:text-white">
             Basic SEO
         </h3>
         <div class="space-y-4 mt-4">
            <x-form.input-text name="meta_title" label="Meta Title"
                value="{{ old('meta_title', $seo?->meta_title ?? '') }}" placeholder="Enter meta title..." />

            <x-form.textarea-input name="meta_description" label="Meta Description"
                placeholder="Enter a description..." rows="2" :value="old('meta_description', $seo?->meta_description ?? '')" />

            <x-form.textarea-input name="meta_keywords" label="Meta Keywords"
                placeholder="Enter keywords separated by commas..." rows="2" :value="old('meta_keywords', $seo?->meta_keywords ?? '')" />
         </div>
     </div>


     <div class="rounded-xl border border-gray-200 dark:border-gray-800 p-5 bg-white dark:bg-gray-900 px-5 py-4 mb-4">
         <h3 class="text-lg font-semibold dark:text-white">
             Advance SEO
         </h3>
         <div class="space-y-4 mt-4">
             <x-form.input-text name="canonical_url" label="Canonical URL"
                 value="{{ old('canonical_url', $seo?->canonical_url ?? '') }}"
                 placeholder="Enter canonical URL..." />


             <x-form.input-text name="og_title" label="Open Graph Title"
                 value="{{ old('og_title', $seo?->og_title ?? '') }}"
                 placeholder="Enter Open Graph title..." />

             <x-form.input-text name="og_description" label="Open Graph Description"
                 value="{{ old('og_description', $seo?->og_description ?? '') }}"
                 placeholder="Enter Open Graph description..." />

             <div class="">
                 <label for="og_image" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">Open
                     Graph
                     Image</label>
                 <x-form.dropzone name="og_image" label="Open Graph Image" value=""
                     placeholder="Upload Open Graph image..." />
             </div>
             <x-form.input-text name="twitter_title" label="Twitter Title"
                 value="{{ old('twitter_title', $seo?->twitter_title ?? '') }}"
                 placeholder="Enter Twitter title..." />

             <x-form.input-text name="twitter_description" label="Twitter Description"
                 value="{{ old('twitter_description', $seo?->twitter_description ?? '') }}"
                 placeholder="Enter Twitter description..." />
             <div class="">
                 <label for="twitter_image"
                     class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">Twitter
                     Image</label>
                 <x-form.dropzone name="twitter_image" label="Twitter Image" value=""
                     placeholder="Upload Twitter image..." />
             </div>
         </div>
     </div>

<div class="rounded-xl border border-gray-200 dark:border-gray-800 p-5 bg-white dark:bg-gray-900 px-5 py-4 mb-4">
         <h3 class="text-lg font-semibold dark:text-white">
             Script and Schema
         </h3>
         <div class="space-y-4 mt-4">
               {{-- Header Scripts --}}
     <div>
         <div id="header-scripts-wrapper">
             <label for="" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">Header
                 Scripts</label>
             @foreach ($headerScripts as $script)
                 <div class="script-row space-y-3 mb-4">
                     <textarea name="header_scripts[]" rows="4" placeholder="Enter header scripts..."
                         class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ $script }}</textarea>

                     <div class="flex justify-end gap-3">
                         <button type="button"
                             class="remove-btn hidden text-sm bg-red-500 py-1.5 px-4 rounded text-white">
                             Remove
                         </button>

                         <button type="button" class="add-btn text-sm bg-brand-600 py-1.5 px-4 rounded text-white">
                             Add New
                         </button>
                     </div>
                 </div>
             @endforeach

         </div>
     </div>

     {{-- Footer Scripts --}}
     <div>
         <div id="footer-scripts-wrapper">
             <label for="" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">Footer
                 Scripts</label>

             @foreach ($footerScripts as $script)
                 <div class="script-row space-y-3 mb-4">
                     <textarea name="footer_scripts[]" rows="4" placeholder="Enter footer scripts..."
                         class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ $script }}</textarea>

                     <div class="flex justify-end gap-3">
                         <button type="button"
                             class="remove-btn hidden text-sm bg-red-500 py-1.5 px-4 rounded text-white">
                             Remove
                         </button>

                         <button type="button" class="add-btn text-sm bg-brand-600 py-1.5 px-4 rounded text-white">
                             Add New
                         </button>
                     </div>
                 </div>
             @endforeach

         </div>
     </div>
     <x-form.textarea-input name="schema_markup" label="Schema Markup" placeholder="Enter schema markup..." rows="4"
         :value="old('schema_markup', $seo?->schema_markup ?? '')" />
         </div>
     </div>


  
 </div>

 <script>
     document.addEventListener('DOMContentLoaded', function() {

         initializeDynamicFields('header-scripts-wrapper', 'header_scripts[]', 'Header Scripts');
         initializeDynamicFields('footer-scripts-wrapper', 'footer_scripts[]', 'Footer Scripts');

         function initializeDynamicFields(wrapperId, inputName, labelText) {
             const wrapper = document.getElementById(wrapperId);

             updateButtons(wrapper);

             wrapper.addEventListener('click', function(e) {

                 /*
                 |--------------------------------------------------------------------------
                 | Add New
                 |--------------------------------------------------------------------------
                 */
                 if (e.target.classList.contains('add-btn')) {

                     const div = document.createElement('div');

                     div.classList.add('script-row', 'space-y-3', 'mb-4');

                     div.innerHTML = `
                    <textarea
                        name="${inputName}"
                        rows="4"
                        placeholder="Enter scripts..."
                        class="dark:bg-dark-900
                shadow-theme-xs
                focus:border-brand-300
                focus:ring-brand-500/10
                dark:focus:border-brand-800
                w-full
                rounded-lg
                border
                border-gray-300
                bg-transparent
                px-4
                py-2.5
                text-sm
                text-gray-800
                placeholder:text-gray-400
                focus:ring-3
                focus:outline-hidden
                dark:border-gray-700
                dark:bg-gray-900
                dark:text-white/90
                dark:placeholder:text-white/30"
                    ></textarea>

                    <div class="flex justify-end gap-3">

                        <button
                            type="button"
                            class="remove-btn text-sm bg-red-500 py-1.5 px-4 rounded text-white"
                        >
                            Remove
                        </button>

                        <button
                            type="button"
                            class="add-btn text-sm bg-brand-600 py-1.5 px-4 rounded text-white"
                        >
                            Add New
                        </button>

                    </div>
                `;

                     wrapper.appendChild(div);

                     updateButtons(wrapper);
                 }

                 /*
                 |--------------------------------------------------------------------------
                 | Remove
                 |--------------------------------------------------------------------------
                 */
                 if (e.target.classList.contains('remove-btn')) {

                     const rows = wrapper.querySelectorAll('.script-row');

                     if (rows.length <= 1) {
                         return;
                     }

                     e.target.closest('.script-row').remove();

                     updateButtons(wrapper);
                 }
             });
         }

         /*
         |--------------------------------------------------------------------------
         | Update Buttons
         |--------------------------------------------------------------------------
         */
         function updateButtons(wrapper) {
             const rows = wrapper.querySelectorAll('.script-row');

             rows.forEach((row, index) => {

                 const addBtn = row.querySelector('.add-btn');
                 const removeBtn = row.querySelector('.remove-btn');

                 // Only last row shows Add button
                 if (index === rows.length - 1) {
                     addBtn.classList.remove('hidden');
                 } else {
                     addBtn.classList.add('hidden');
                 }

                 // Hide remove if only one row
                 if (rows.length === 1) {
                     removeBtn.classList.add('hidden');
                 } else {
                     removeBtn.classList.remove('hidden');
                 }
             });
         }
     });
 </script>
