<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
   <div class="mt-8 text-2xl">
       Welcome to your Jetstream application!
   </div>

   <div class="mt-6">
      <div class="flex justify-between">
         <div></div>
         <div class="mr-2">
            <input type="checkbox" class="mr-6 leading-tigth" wire:model='active'>
            Active Only?
         </div>
      </div>
      <table class="table-auto w-full">
         <thead>
            <tr>
               <th class="px-4 py-2">
                  <div class="flex items center">ID</div>
               </th>
               <th class="px-4 py-2">
                  <div class="flex items center">Name</div>
               </th>
               <th class="px-4 py-2">
                  <div class="flex items center">Price</div>
               </th>
               <th class="px-4 py-2">
                  Status
               </th>
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
                  <td class="border px-4 py-2"> {{ $product->status ? 'Active' : 'Not-Active' }}</td>
                  <td class="border px-4 py-2"> Edit Delete</td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   <div class="div mt-4">
      {{ $products-> links() }}
   </div>
</div>
