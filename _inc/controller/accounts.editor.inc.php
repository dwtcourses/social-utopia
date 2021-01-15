<div class="account_manager">
    <p><span class="account_title">Account Manager</span>
        <?php
        // Contains left sidebar, account manager and navigator

        if (isset($_GET['manageSelectedFacebookPage']) || isset($_SESSION['lastFbPageToManage'])) {

            if (isset($_GET['manageSelectedFacebookPage'])) {
                $selectedFacebookPage = $_GET['manageSelectedFacebookPage'];
                $_SESSION['lastFbPageToManage'] = $selectedFacebookPage;
            }

            if (isset($_SESSION['lastFbPageToManage']))
                $selectedFacebookPage = $_SESSION['lastFbPageToManage'];

            $fbPageId =  $selectedFacebookPage;

            //echo '<pre>';
            //print_r($_SESSION);
            //echo '</pre>';
            $currentPgName = $_SESSION['userInformation']->$selectedFacebookPage->pageName;
            // PHP Close 
        ?>
            <span class="account_network">Facebook Page</span>
            <select onChange="fbPgSelectorChange(this);" class="form-control fbPgSelector">

                <?php
                // Add select menu to chose which Facebook page to manage

                if (isset($_SESSION['userInformation'])) {
                    foreach ($_SESSION['userInformation'] as $fbPage => $pgInfo) {
                        foreach ($pgInfo as $fbPageInfoField => $detailedPgInfo) {
                            // Print options for select dropdown
                            if ($fbPageInfoField == 'pageName') {
                                echo '<option value="' . $fbPage . '"';
                                if ($currentPgName == $detailedPgInfo) {
                                    echo ' selected';
                                }
                                echo '>' . $detailedPgInfo . '</option>';
                            }
                        }
                    }
                }
                ?>
            </select>
    </p>
    <p>
    <?php // PHP Start
            $_SESSION['userInformation']->lastManagedPgId = $_SESSION['lastFbPageToManage'];
        } else {
    ?>
        <span class="account_network">Facebook</span>
        Select page to manage
    <?php
        }
        // Include Twitter Management Code
        require_once('./_inc/view/twitter.inc.php');

        // Include LinkedIn Management Code
        require_once('./_inc/view/logIn.linkedIn.php');

        // Include Google My Business Management Code
        require_once('./_inc/view/login.google.inc.php');
    ?>
    </p>
</div>