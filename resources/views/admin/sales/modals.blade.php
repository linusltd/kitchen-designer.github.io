 <!-- Modal -->
 <div class="modal fade" id="loadProductsModal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-xl" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel1"><i class="fa fa-plus"></i> Select Products To Load</h5>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-4 mb-2">
                         <input type="text" name="search" id="search" placeholder="Search Book"
                             class="form-control">
                     </div>
                     <div class="col-12">
                         <table class="table">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Image</th>
                                     <th>Book Name</th>
                                     <th>SKU</th>
                                     <th>Price</th>
                                     <th>Stock</th>
                                     <th>Load</th>
                                 </tr>
                             </thead>
                             <tbody id="loadProductsBody">

                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
