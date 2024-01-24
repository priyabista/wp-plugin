<table id="table" class="table">
    <thead>
        <tr>
            <div class="d-flex align-items-center">
            <span><input type="text" id="searchInput" placeholder="<?php esc_html_e( 'Search...', 'contact-form' ); ?>"></span>
                <button id="searchButton" class="ms-2"><?php esc_html_e( 'Search', 'contact-form' ); ?></button>
            </div>
        </tr>
            <div class="my-4"></div>
        <tr>
            <th>
                <div class="d-flex align-items-center">
                    <span><?php esc_html_e( 'Name', 'contact-form' ); ?></span>
                    <div class="dropdown ms-2">
                        <button id="sortDropdown" type="button" class="btn btn-primary dropdown-toggle" 
                            data-bs-toggle="dropdown" data-sort-order="ASC">
                        </button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" id="name_asc" value="ASC"><?php esc_html_e( 'ASC', 'contact-form' ); ?></a></li>
                            <li><a class="dropdown-item" id="name_desc" value="DESC"><?php esc_html_e( 'DESC', 'contact-form' ); ?></a></li>
                        </ul>
                    </div>
                </div>
            </th>

            <th>
                <div class="d-flex align-items-center">
                   <span><?php esc_html_e( 'Email', 'contact-form' ); ?></span>
                    <div class="dropdown ms-2">
                        <button id="sortDropdown" type="button" class="btn btn-primary dropdown-toggle" 
                        data-bs-toggle="dropdown" data-sort-order="ASC">
                        </button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" id="asc" value="ASC" ><?php esc_html_e( 'ASC', 'contact-form' ); ?></a></li>
                            <li><a class="dropdown-item" id="desc" value="DESC"><?php esc_html_e( 'DESC', 'contact-form' ); ?></a></li>
                        </ul>
                    </div>
                </div>
            </th>
            <th><?php esc_html_e( 'Subject', 'contact-form' ); ?></th>
            <th><?php esc_html_e( 'Message', 'contact-form' ); ?></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
