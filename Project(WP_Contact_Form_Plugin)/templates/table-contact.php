<table id="table" class="table">
    <thead>
    
        <tr>
            <div class="d-flex align-items-center">
            <span><input type="text" id="searchInput" placeholder="<?php _e('Search...', 'contact-form'); ?>"></span>
                <button id="searchButton" class="ms-2"><?php _e('Search', 'contact-form'); ?></button>
            </div>
            

        </tr>
            <div class="my-4"></div>
        <tr>
            <th>
                <div class="d-flex align-items-center">
                    <span><?php _e('Name', 'contact-form'); ?></span>
                    <div class="dropdown ms-2">
                        <button id="sortDropdown" type="button" class="btn btn-primary dropdown-toggle" 
                            data-bs-toggle="dropdown" data-sort-order="ASC">
                        </button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" id="name_asc" value="ASC"><?php _e('ASC', 'contact-form'); ?></a></li>
                            <li><a class="dropdown-item" id="name_desc" value="DESC"><?php _e('DESC', 'contact-form'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </th>

            <th>
                <div class="d-flex align-items-center">
                   <span><?php _e('Email', 'contact-form'); ?></span>
                    <div class="dropdown ms-2">
                        <button id="sortDropdown" type="button" class="btn btn-primary dropdown-toggle" 
                        data-bs-toggle="dropdown" data-sort-order="ASC">
                        </button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" id="asc" value="ASC" ><?php _e('ASC', 'contact-form'); ?></a></li>
                            <li><a class="dropdown-item" id="desc" value="DESC"><?php _e('DESC', 'contact-form'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </th>
            <th><?php _e('Subject', 'contact-form'); ?></th>
            <th><?php _e('Message', 'contact-form'); ?></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
