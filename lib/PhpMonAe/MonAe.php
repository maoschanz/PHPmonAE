<?php

namespace PhpMonAe;

class MonAe
{
    private $_nameApp;
    private $_email;
    private $_firmid;
    private $_login;
    private $_password;

    /*
     * Constructeur
     */
    public function __construct($_email, $_firmid, $_login, $_password, $_nameApp = 'MonAE app')
    {
        $this->set_email($_email);
        $this->set_firmid($_firmid);
        $this->set_login($_login);
        $this->set_password($_password);
        $this->set_nameApp($_nameApp);
    }

    /**
     * Set the firm ID
     *
     * @param String $_firmid
     */
    private function set_firmid($_firmid)
    {
        if (!$_firmid) {
            throw new MonAeException('Le firm id est obligatoire.');
        }
        $this->_firmid = $_firmid;
    }

    /**
     * Set the login access
     *
     * @param String $_login
     */
    private function set_login($_login)
    {
        if (!$_login) {
            throw new MonAeException('Le login est obligatoire.');
        }
        $this->_login = $_login;
    }

    /**
     * Set the password access
     *
     * @param String $_password
     */
    private function set_password($_password)
    {
        if (!$_password) {
            throw new MonAeException('Le mot de passe est obligatoire.');
        }
        $this->_password = $_password;
    }

    /**
     * Set the email
     *
     * @param String $_email
     */
    private function set_email($_email)
    {
        if (!$_email) {
            throw new MonAeException('L\'email est obligatoire.');
        }
        $this->_email = $_email;
    }

    /**
     * Set the name app
     *
     * @param String $_nameApp
     */
    private function set_nameApp($_nameApp)
    {
        if (!$_nameApp) {
            throw new MonAeException('Le nom de l\'application est obligatoire.');
        }
        $this->_nameApp = $_nameApp;
    }

    /**
     *  CUSTOMERS
     *
     */

    /**
     * Get the list of all customers that corresponds with options
     *
     * @param array $options
     *          int page
     *          int api_id
     *          int api_custom
     *          String company
     *          String last_name
     *          String email
     *
     */
    public function getCustomers($options = array())
    {
        return $this->getListe("customers", $options);
    }

    /**
     * Get a customer with the $_ID
     *
     * @param int $_ID
     */
    public function getCustomer($_ID)
    {
        return $this->getUnique("customers", $_ID);
    }


    /**
     * Create a new customer with options values
     *
     * @param array $options
     *
     */
    public function newCustomer($options = array())
    {
        return $this->newItem("customer", "customers", $options);
    }

    /**
     * Update a customr with options values
     *
     * @param int $_ID
     * @param array $options
     *
     */
    public function updateCustomer($_ID, $options = array())
    {
        return $this->updateItem("customers", $_ID, $options);
    }

    /**
     * Quotes
     *
     */

    /**
     * Get the list of all quotes that corresponds with options
     *
     * @param array $options
     *          int page
     *          int quote_ref
     *          String title
     *          int customer_id
     *          int api_id
     *          int api_custom
     *          String company
     *          String last_name
     *
     */
    public function getQuotes($options = array())
    {
        return $this->getListe("quotes", $options);
    }


    /**
     * Get a quote with the $_ID
     *
     * @param int $_ID
     *
     */
    public function getQuote($_ID)
    {
        return $this->getUnique("quotes", $_ID);
    }

    /**
     * Get the PDF's quote with the $_ID
     *
     * @param int $_ID
     * @param bool $afficher
     *          Show or not the pdf document
     */
    public function getQuotePDF($_ID, $afficher = false)
    {
        $return = $this->getPDF("quotes", $_ID);
        if ($afficher) {
            header("Content-type: application/pdf");
            echo $return;
        } else {
            return $return;
        }
    }

    /**
     * Create a new quote with options values
     *
     * @param array $options
     *
     */
    public function newQuote($options = array())
    {
        return $this->newItem('quote', 'quotes', $options);
    }

    /**
     * Invoices
     *
     */

    /**
     * Get the list of all invoices that corresponds with options
     *
     * @param array $options
     *          int page
     *          int invoice_ref
     *          String title
     *          int customer_id
     *          int api_id
     *          int api_custom
     *          String company
     *          String last_name
     *
     */
    public function getInvoices($options = array())
    {
        return $this->getListe("invoices", $options);
    }


    /**
     * Get a invoice with the $_ID
     *
     * @param int $_ID
     */
    public function getInvoice($_ID)
    {
        return $this->getUnique("invoices", $_ID);
    }

    /**
     * Get the PDF's invoice with the $_ID
     *
     * @param int $_ID
     * @param bool $afficher
     *          Show or not the pdf document
     */
    public function getInvoicePDF($_ID, $afficher = false)
    {
        $return = $this->getPDF("invoices", $_ID);
        if ($afficher) {
            header("Content-type: application/pdf");
            echo $return;
        } else {
            return $return;
        }
    }


    /**
     * Create a new invoice with options values
     *
     * @param array $options
     *
     */
    public function newInvoice($options = array(), $draft = false)
    {
        if ($draft) {
            $parameters = array('type_doc' => 'draft');
        } else {
            $parameters = array();
        }

        return $this->newItem("invoice", "invoices", $options, $parameters);
    }

    /**
     * Suppliers
     *
     */

    /**
     * Get the list of all supplier that corresponds with options
     *
     * @param array $options
     *          int page
     *          int api_id
     *          int api_custom
     *          String company
     *
     */
    public function getSuppliers($options = array())
    {
        return $this->getListe("suppliers", $options);
    }


    /**
     * Get a supplier with the $_ID
     *
     * @param int $_ID
     */
    public function getSupplier($_ID)
    {
        return $this->getUnique("suppliers", $_ID);
    }


    /**
     * Create a new supplier with options values
     *
     * @param array $options
     *
     */
    public function newSupplier($options = array())
    {
        return $this->newItem("supplier", "suppliers", $options);
    }

    /**
     * Purchases
     *
     */

    /**
     * Get the list of all purchase that corresponds with options
     *
     * @param array $options
     *          int page
     *          String title
     *          int api_id
     *          int api_custom
     *          String company
     *
     */
    public function getPurchases($options = array())
    {
        return $this->getListe("purchases", $options);
    }


    /**
     * Get a purchase with the $_ID
     *
     * @param int $_ID
     */
    public function getPurchase($_ID)
    {
        return $this->getUnique("purchases", $_ID);
    }

    /**
     * Create a new purchase with options values
     *
     * @param array $options
     *
     */
    public function newPurchase($options = array())
    {
        return $this->newItem("purchase", "purchases", $options);
    }


    /**
     * Produits
     */

    /**
     * Get the list of all products that corresponds with options
     *
     * @param array $options
     *          String ref
     *          String title
     *          int api_id
     *          int api_custom
     */
    public function getProducts($options = array())
    {
        $return = $this->getListe("products", $options);
        return $return;
    }

    /**
     * Get a product with the $_ID
     *
     * @param int $_ID
     */
    public function getProduct($_ID)
    {
        $return = $this->getUnique("products", $_ID);
        return $return;
    }

    /**
     * Create a new product with options values
     *
     * @param array $options
     *          String title
     *          int status
     */
    public function newProduct($options = array())
    {
        return $this->newItem("product", "products", $options);
    }

    /**
     * Categories
     */

    /**
     * Get the list of all categories that corresponds with options
     *
     * @param array $options
     *          int page
     *          String title
     *          int status
     */
    public function getCategories($options = array())
    {
        $return = $this->getListe("categories", $options);
        return $return;
    }

    /**
     * Get a category with the $_ID
     *
     * @param int $_ID
     */
    public function getCategory($_ID)
    {
        $return = $this->getUnique("categories", $_ID);
        return $return;
    }

    /**
     * Create a new category with options values
     *
     * @param array $options
     *          String title
     *          int status
     */
    public function newCategory($options = array())
    {
        return $this->newItem("category", "categories", $options);
    }

    /**
     * Mains functions
     *
     */
    private function getListe($name, $options = array())
    {
        $url = "";
        if (!empty($options)) {
            $url = "?" . http_build_query($options);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/" . $this->_firmid . "/" . $name . ".json" . $url);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_login . ":" . $this->_password);
        curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: ' . $this->_nameApp . ' (' . $this->_email . ')');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        $return = curl_exec($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);

        $curlHeader = substr($return, 0, $info['header_size']);

        preg_match('/X-Pagination: (.*)/i', $curlHeader, $preg);
        $pagination = null;
        if( $preg > 0 ) {
            $pagination = $preg[1];
        }

        return $this->getOutput($return, $pagination);
    }

    private function getUnique($name, $_ID)
    {
        if (!$_ID) {
            throw new MonAeException("Vous avez oublié l'ID !");
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/" . $this->_firmid . "/" . $name . "/" . $_ID . ".json");
        curl_setopt($curl, CURLOPT_USERPWD, $this->_login . ":" . $this->_password);
        curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: ' . $this->_nameApp . ' (' . $this->_email . ')');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        $return = curl_exec($curl);
        curl_close($curl);

        return $this->getOutput($return);
    }

    private function getPDF($name, $_ID)
    {
        if (!$_ID) {
            throw new MonAeException("Vous avez oublié l'ID !");
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/" . $this->_firmid . "/" . $name . "/" . $_ID . ".pdf");
        curl_setopt($curl, CURLOPT_USERPWD, $this->_login . ":" . $this->_password);
        curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: ' . $this->_nameApp . ' (' . $this->_email . ')');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        $return = curl_exec($curl);
        curl_close($curl);

        return $return;
    }

    private function newItem($name, $plurial, $options = array(), $parameters = array())
    {
        $creation = json_encode($options);

        $param = $this->parseParameters($parameters);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.facturation.pro/firms/' . $this->_firmid . '/' . $plurial . '.json'. $param);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $creation);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_login . ":" . $this->_password);
        curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: ' . $this->_nameApp . ' (' . $this->_email . ')');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($curl, CURLOPT_HEADER, true);

        $return = curl_exec($curl);
        curl_close($curl);
        return $this->getOutput($return);
    }

    private function updateItem($name, $_ID, $options = array())
    {
        if (!$_ID) {
            throw new MonAeException("Vous avez oublié l'ID !");
        }

        $creation = json_encode($options);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/" . $this->_firmid . "/" . $name . "/" . $_ID . ".json");

        curl_setopt($curl, CURLOPT_USERPWD, $this->_login . ":" . $this->_password);
        curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: ' . $this->_nameApp . ' (' . $this->_email . ')');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $creation);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_HEADER, true);

        $return = curl_exec($curl);
        curl_close($curl);
        return $this->getOutput($return);
    }

    private function getOutput($return, $pagination = null)
    {
        $response = new \stdClass();

        $return = explode("\n", $return);
        $json_resp = end($return);
        $status = "";
        foreach ($return as $key => $value) {
            if (stripos($value, "Status:") > -1) {
                $status = explode(" ", $value);
                break;
            }
        }

        $code = (int)$status[1];
        $message = end($status);

        //gestion des erreurs
        if ($code >= 400) {
            $response->error = new \stdClass();

            $response->error->is_error = true;
            $response->error->code_error = $code;
            $response->error->message = $message;
        }

        $response->response = json_decode($json_resp);

        if ($pagination) {
            $response->pagination = json_decode($pagination);
        }

        return $response;
    }

    private function parseParameters($parameters) {

        $param_string = '';

        foreach( $parameters as $key => $value ) {
            if( $param_string == '' ) {
                $param_string .= '?';
            }
            else {
                $param_string .= '&';
            }

            $param_string .= $key .'='. $value;
        }

        return $param_string;
    }
}

?>
