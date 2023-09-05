 <div class="d-sm-flex justify-content-between">
     <div>
         <h5 class="text-white font-weight-bold mb-0 d-none" id="filterLabel"></h5>
     </div>
     <div class="d-flex">
         <div class="dropdown d-inline">
             <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle text-white border-white"
                 data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                 Filters <i class="fas fa-filter ms-2"></i>
             </a>
             <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2"
                 data-popper-placement="left-start">

                 <li><a class="dropdown-item border-radius-md filter" data-filter="1" href="javascript:;">Status:
                         Active</a>
                 </li>
                 <li><a class="dropdown-item border-radius-md filter" data-filter="0" href="javascript:;">Status:
                         InActive</a>
                 </li>
                 <li><a class="dropdown-item border-radius-md filter" data-filter="2" href="javascript:;">Status:
                         Blocked</a>
                 </li>
                 <li>
                     <hr class="horizontal dark my-2">
                 </li>
                 <li><a class="dropdown-item border-radius-md filter text-primary border-primary" data-filter="deleted"
                         href="javascript:;">User
                         Deleted</a>
                 </li>
                 <li>
                     <hr class="horizontal dark my-2">
                 </li>
                 <li><a class="dropdown-item border-radius-md text-danger filter" data-filter="clear"
                         href="javascript:;">Remove
                         Filter</a></li>
             </ul>
         </div>
     </div>
 </div>
