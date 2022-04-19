<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
   <div class="mt-8 text-2xl">
      Welcome to your Jetstream application!
   </div>

   {{ $query }}
   <div class="mt-6">
      <div class="flex justify-between">
         <div class="flex justify-center">
            <div class="mb-3 xl:w-96">
               <div class="input-group relative flex flex-wrap items-stretch w-full mb-4 rounded">
                  <input wire:model="search" type="search"
                     class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                     placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                  <span
                     class="input-group-text flex items-center px-3 py-1.5 text-base font-normal text-gray-700 text-center whitespace-nowrap rounded"
                     id="basic-addon2">
                  </span>
               </div>
            </div>
         </div>
         <div class="mr-2">
            <input type="checkbox" class="mr-6 leading-tigth" wire:model='active'>
            Active Only?
         </div>
      </div>
      <table class="table-auto w-full">
         <thead>
            <tr>
               <th class="px-4 py-2">
                  <div class="flex items center">
                     <button wire:click="sortBy('id')">ID</button>
                     <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                  </div>
               </th>
               <th class="px-4 py-2">
                  <div class="flex items center">
                     <button wire:click="sortBy('name')">Name</button>
                     <x-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                  </div>
   </div>
   </th>
   <th class="px-4 py-2">
      <div class="flex items center">
         <button wire:click="sortBy('price')">Price</button>
         <x-sort-icon sortField="price" :sort-by="$sortBy" :sort-asc="$sortAsc" />
      </div>
</div>
</div>
</th>
@if (!$active)
<th class="px-4 py-2">
   Status
</th>
@endif
<th class="px-4 py-2">
   Actions
</th>
</tr>
</thead>
<tbody>
   @foreach ($products as $product)
   <tr>
      <td class="border px-4 py-2"> {{ $product->id }}</td>
      <td class="border px-4 py-2"> {{ $product->name }}</td>
      <td class="border px-4 py-2"> {{ number_format($product->price, 2) }}</td>
      @if (!$active)
      <td class="border px-4 py-2"> {{ $product->status ? 'Active' : 'Not-Active' }}</td>
      @endif
      <td class="border px-4 py-2">
         Edit
         <x-jet-danger-button wire:click="confirmProductDeletion ( {{ $product->id }} )" wire:loading.attr="disabled">
            Delete
         </x-jet-danger-button>
      </td>
   </tr>
   @endforeach
</tbody>
</table>
</div>
<div class="div mt-4">
   {{ $products-> links() }}
</div>
<x-jet-dialog-modal wire:model="confirmingProductDeletion">
   <x-slot name="title">
      {{ __('Delete Product') }}
   </x-slot>

   <x-slot name="content">
      {{ __('Are you sure you want to delete your Product?.') }}
   </x-slot>

   <x-slot name="footer">
      <x-jet-secondary-button wire:click="$set('confirmingProductDeletion', false)" wire:loading.attr="disabled">
         {{ __('Cancel') }}
      </x-jet-secondary-button>

      <x-jet-danger-button class="ml-3" wire:click="deleteProduct ({{ $confirmingProductDeletion }})" wire:loading.attr="disabled">
         {{ __('Delete') }}
      </x-jet-danger-button>
   </x-slot>
</x-jet-dialog-modal>
</div>