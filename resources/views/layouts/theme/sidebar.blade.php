  <div class="sidebar-wrapper sidebar-theme">

      <nav id="sidebar">

          <div class="navbar-nav theme-brand flex-column  text-center">
              <div class="nav-logo justify-content-center bg-light p-2">
                  <div class="nav-item  flex text-center">
                      <a href="route('customers')" class=" flex-row text-center">
                          <img src="{{asset('img/logo2.svg')}}"  alt="logo" width="100px">
                      </a>
                  </div>
                  
              </div>
              <div class="">
                <a href="#" class="nav-link "> INVERSIONES DEL SUR</a>
            </div>
             
          </div>
          <div class="shadow-bottom"></div>
          <ul class="list-unstyled menu-categories" id="accordionExample">
              <li class="menu active">
                  <a href="#dashboard" data-bs-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                      <div class="">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                              <polyline points="9 22 9 12 15 12 15 22"></polyline>
                          </svg>
                          <span>Dashboard</span>
                      </div>
                      <div>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                              <polyline points="9 18 15 12 9 6"></polyline>
                          </svg>
                      </div>
                  </a>
                  
              </li>

              <li class="menu menu-heading">
                  <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                      </svg><span>MODULOS</span></div>
              </li>

              <li class="menu d-flex">
                  <a href="{{route('loans')}}" aria-expanded="false" class="dropdown-toggle ">
                      
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                              <line x1="16" y1="2" x2="16" y2="6"></line>
                              <line x1="8" y1="2" x2="8" y2="6"></line>
                              <line x1="3" y1="10" x2="21" y2="10"></line>
                          </svg>
                          <span>PRESTAMOS</span>
                      
                  </a>
              </li>

              <li class="menu d-flex">
                  <a href="#" aria-expanded="false" class="dropdown-toggle">
                    
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                          </svg>
                          <span>PAGOS</span>
                      
                  </a>
              </li>

              <li class="menu d-flex">
                  <a href="{{route('customers')}}" aria-expanded="false" class="dropdown-toggle">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                              <polyline points="22,6 12,13 2,6"></polyline>
                          </svg>
                          <span>CLIENTES</span>
                  </a>
              </li>

              <li class="menu d-flex">
                  <a href="{{route('users')}}" aria-expanded="false" class="dropdown-toggle">
                      
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                          </svg>
                          <span>TRABAJADORES</span>
                      
                  </a>
              </li>


              <li class="menu menu-heading">
                  <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                      </svg><span>CONFIGURACIONES</span></div>
              </li>

              <li class="menu d-flex">
                  <a href="{{route('rates')}}" aria-expanded="false" class="dropdown-toggle">
                      
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                          </svg>
                          <span>PORCENTAJE</span>
                     
                  </a>
              </li>
              <li class="menu d-flex">
                  <a href="{{route('frecuencias')}}" aria-expanded="false" class="dropdown-toggle">
                     
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                          </svg>
                          <span>TIPO PAGO</span>
                      
                  </a>
              </li>
              <li class="menu d-flex">
                <a href="{{route('reportes')}}" aria-expanded="false" class="dropdown-toggle">
                   
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        <span>REPORTES</span>
                    
                </a>
            </li>


          </ul>

      </nav>




  </div>