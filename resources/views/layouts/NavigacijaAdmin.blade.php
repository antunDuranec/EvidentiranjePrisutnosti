
<nav class="sidenav"style="margin-top: 4%" data-sidenav data-sidenav-toggle="#sidenav-toggle">

    <div class="sidenav-brand">
        Admin panel
    </div>

    <!--KOLEGIJI-->
    <ul class="sidenav-menu">
        <li>
            <a href="javascript:;" data-sidenav-dropdown-toggle class="active">

                  <span class="sidenav-link-icon">
                    <i class="material-icons">store</i>
                  </span>

                <span class="sidenav-link-title">Kolegiji</span>

                <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                        <i class="material-icons">arrow_drop_down</i>
                  </span>

                <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                        <i class="material-icons">arrow_drop_up</i>
                  </span>

            </a>

            <ul class="sidenav-dropdown" data-sidenav-dropdown>
                <li><a href="/admin/kolegij">Pregled kolegija</a></li>
                <li><a href="/admin/kolegij/create">Unos kolegija</a></li>
            </ul>

        </li>

        <!--RAZINA PRISTUPA-->
        <li>
            <a href="javascript:;" data-sidenav-dropdown-toggle>

                <span class="sidenav-link-icon">
                    <i class="material-icons">payment</i>
                </span>

                <span class="sidenav-link-title">Razine pristupa</span>

                <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                     <i class="material-icons">arrow_drop_down</i>
                </span>

                <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                    <i class="material-icons">arrow_drop_up</i>
                </span>

            </a>

            <ul class="sidenav-dropdown" data-sidenav-dropdown>
                <li><a href="/admin/razina-prava">Pregled razina</a></li>
                <li><a href="/admin/razina-prava/create">Unos razine</a></li>
            </ul>

        </li>

        <!--KORISNICI-->
        <li>
            <a href="javascript:;" data-sidenav-dropdown-toggle>

                <span class="sidenav-link-icon">
                     <i class="material-icons">shopping_cart</i>
                </span>

                <span class="sidenav-link-title">Korisnici</span>

                <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                    <i class="material-icons">arrow_drop_down</i>
                </span>

                <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                    <i class="material-icons">arrow_drop_up</i>
                </span>

            </a>

            <ul class="sidenav-dropdown" data-sidenav-dropdown>
                <li><a href="/admin/profesor-kolegij/create">Poveži profesor-kolegij</a></li>
                <li><a href="/admin/student-kolegij/create">Poveži student-kolegij</a></li>
                <li><a href="/admin/korisnik/create">Unos korisnika</a></li>
            </ul>

        </li>

        <!--PREGLED-->
        <li>
            <a href="javascript:;" data-sidenav-dropdown-toggle>

                <span class="sidenav-link-icon">
                     <i class="material-icons">shopping_cart</i>
                </span>

                <span class="sidenav-link-title">Pregled</span>

                <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                    <i class="material-icons">arrow_drop_down</i>
                </span>

                <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                    <i class="material-icons">arrow_drop_up</i>
                </span>

            </a>

            <ul class="sidenav-dropdown" data-sidenav-dropdown>
                <li><a href="/admin/razina-prava/3">Pregled studenata</a></li>
                <li><a href="/admin/razina-prava/2">Pregled profesora</a></li>
                <li><a href="/admin/student-kolegij">Pregled studenata po kolegiju</a></li>
                <li><a href="/admin/profesor-kolegij">Pregled profesora po kolegiju</a></li>

            </ul>

        </li>

        <!--Evidencija-->
        <li>
            <a href="javascript:;" data-sidenav-dropdown-toggle>

                <span class="sidenav-link-icon">
                     <i class="material-icons">shopping_cart</i>
                </span>

                <span class="sidenav-link-title">Evidencija</span>

                <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                    <i class="material-icons">arrow_drop_down</i>
                </span>

                <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                    <i class="material-icons">arrow_drop_up</i>
                </span>

            </a>

            <ul class="sidenav-dropdown" data-sidenav-dropdown>
                <li><a href="/termin/">Pregled termina</a></li>
                <li><a href="/termin/create">Unos termina</a></li>

            </ul>

        </li>

    </ul>

</nav>

<a href="#" class="toggle" id="sidenav-toggle" style="padding: 5%;margin-left: -5%">
    <i class="material-icons">menu</i>
</a>
