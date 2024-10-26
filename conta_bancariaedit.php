<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg11.php" ?>
<?php include_once "ewmysql11.php" ?>
<?php include_once "phpfn11.php" ?>
<?php include_once "conta_bancariainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn11.php" ?>
<?php

//
// Page class
//

$conta_bancaria_edit = NULL; // Initialize page object first

class cconta_bancaria_edit extends cconta_bancaria {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{2B7992FC-5911-46A7-9310-01F4D4225C49}";

	// Table name
	var $TableName = 'conta_bancaria';

	// Page object name
	var $PageObjName = 'conta_bancaria_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}
	var $AuditTrailOnEdit = TRUE;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME]);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		$GLOBALS["Page"] = &$this;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (conta_bancaria)
		if (!isset($GLOBALS["conta_bancaria"]) || get_class($GLOBALS["conta_bancaria"]) == "cconta_bancaria") {
			$GLOBALS["conta_bancaria"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["conta_bancaria"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// User table object (usuarios)
		if (!isset($GLOBALS["UserTable"])) $GLOBALS["UserTable"] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'conta_bancaria', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate(ew_GetUrl("conta_bancarialist.php"));
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->Id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn, $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $conta_bancaria;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($conta_bancaria);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;

		// Load key from QueryString
		if (@$_GET["Id"] <> "") {
			$this->Id->setQueryStringValue($_GET["Id"]);
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($this->Id->CurrentValue == "")
			$this->Page_Terminate("conta_bancarialist.php"); // Invalid key, return to list

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("conta_bancarialist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $this->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Id->FldIsDetailKey)
			$this->Id->setFormValue($objForm->GetValue("x_Id"));
		if (!$this->Banco->FldIsDetailKey) {
			$this->Banco->setFormValue($objForm->GetValue("x_Banco"));
		}
		if (!$this->Agencia->FldIsDetailKey) {
			$this->Agencia->setFormValue($objForm->GetValue("x_Agencia"));
		}
		if (!$this->Conta->FldIsDetailKey) {
			$this->Conta->setFormValue($objForm->GetValue("x_Conta"));
		}
		if (!$this->Gerente->FldIsDetailKey) {
			$this->Gerente->setFormValue($objForm->GetValue("x_Gerente"));
		}
		if (!$this->Telefone->FldIsDetailKey) {
			$this->Telefone->setFormValue($objForm->GetValue("x_Telefone"));
		}
		if (!$this->Limite->FldIsDetailKey) {
			$this->Limite->setFormValue($objForm->GetValue("x_Limite"));
		}
		if (!$this->Site->FldIsDetailKey) {
			$this->Site->setFormValue($objForm->GetValue("x_Site"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->Id->CurrentValue = $this->Id->FormValue;
		$this->Banco->CurrentValue = $this->Banco->FormValue;
		$this->Agencia->CurrentValue = $this->Agencia->FormValue;
		$this->Conta->CurrentValue = $this->Conta->FormValue;
		$this->Gerente->CurrentValue = $this->Gerente->FormValue;
		$this->Telefone->CurrentValue = $this->Telefone->FormValue;
		$this->Limite->CurrentValue = $this->Limite->FormValue;
		$this->Site->CurrentValue = $this->Site->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->Id->setDbValue($rs->fields('Id'));
		$this->Banco->setDbValue($rs->fields('Banco'));
		$this->Agencia->setDbValue($rs->fields('Agencia'));
		$this->Conta->setDbValue($rs->fields('Conta'));
		$this->Gerente->setDbValue($rs->fields('Gerente'));
		$this->Telefone->setDbValue($rs->fields('Telefone'));
		$this->Limite->setDbValue($rs->fields('Limite'));
		$this->Site->setDbValue($rs->fields('Site'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->Id->DbValue = $row['Id'];
		$this->Banco->DbValue = $row['Banco'];
		$this->Agencia->DbValue = $row['Agencia'];
		$this->Conta->DbValue = $row['Conta'];
		$this->Gerente->DbValue = $row['Gerente'];
		$this->Telefone->DbValue = $row['Telefone'];
		$this->Limite->DbValue = $row['Limite'];
		$this->Site->DbValue = $row['Site'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Limite->FormValue == $this->Limite->CurrentValue && is_numeric(ew_StrToFloat($this->Limite->CurrentValue)))
			$this->Limite->CurrentValue = ew_StrToFloat($this->Limite->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// Id
		// Banco
		// Agencia
		// Conta
		// Gerente
		// Telefone
		// Limite
		// Site

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// Id
			$this->Id->ViewValue = $this->Id->CurrentValue;
			$this->Id->ViewCustomAttributes = "";

			// Banco
			if (strval($this->Banco->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->Banco->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `id`, `N_do_Banco` AS `DispFld`, `Banco` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `bancos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->Banco, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->Banco->ViewValue = $rswrk->fields('DispFld');
					$this->Banco->ViewValue .= ew_ValueSeparator(1,$this->Banco) . $rswrk->fields('Disp2Fld');
					$rswrk->Close();
				} else {
					$this->Banco->ViewValue = $this->Banco->CurrentValue;
				}
			} else {
				$this->Banco->ViewValue = NULL;
			}
			$this->Banco->ViewCustomAttributes = "";

			// Agencia
			$this->Agencia->ViewValue = $this->Agencia->CurrentValue;
			$this->Agencia->ViewCustomAttributes = "";

			// Conta
			$this->Conta->ViewValue = $this->Conta->CurrentValue;
			$this->Conta->ViewCustomAttributes = "";

			// Gerente
			$this->Gerente->ViewValue = $this->Gerente->CurrentValue;
			$this->Gerente->ViewCustomAttributes = "";

			// Telefone
			$this->Telefone->ViewValue = $this->Telefone->CurrentValue;
			$this->Telefone->ViewCustomAttributes = "";

			// Limite
			$this->Limite->ViewValue = $this->Limite->CurrentValue;
			$this->Limite->ViewCustomAttributes = "";

			// Site
			$this->Site->ViewValue = $this->Site->CurrentValue;
			$this->Site->ViewCustomAttributes = "";

			// Id
			$this->Id->LinkCustomAttributes = "";
			$this->Id->HrefValue = "";
			$this->Id->TooltipValue = "";

			// Banco
			$this->Banco->LinkCustomAttributes = "";
			$this->Banco->HrefValue = "";
			$this->Banco->TooltipValue = "";

			// Agencia
			$this->Agencia->LinkCustomAttributes = "";
			$this->Agencia->HrefValue = "";
			$this->Agencia->TooltipValue = "";

			// Conta
			$this->Conta->LinkCustomAttributes = "";
			$this->Conta->HrefValue = "";
			$this->Conta->TooltipValue = "";

			// Gerente
			$this->Gerente->LinkCustomAttributes = "";
			$this->Gerente->HrefValue = "";
			$this->Gerente->TooltipValue = "";

			// Telefone
			$this->Telefone->LinkCustomAttributes = "";
			$this->Telefone->HrefValue = "";
			$this->Telefone->TooltipValue = "";

			// Limite
			$this->Limite->LinkCustomAttributes = "";
			$this->Limite->HrefValue = "";
			$this->Limite->TooltipValue = "";

			// Site
			$this->Site->LinkCustomAttributes = "";
			$this->Site->HrefValue = "";
			$this->Site->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// Id
			$this->Id->EditAttrs["class"] = "form-control";
			$this->Id->EditCustomAttributes = "";

			// Banco
			$this->Banco->EditAttrs["class"] = "form-control";
			$this->Banco->EditCustomAttributes = "";
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `N_do_Banco` AS `DispFld`, `Banco` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `bancos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->Banco, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->Banco->EditValue = $arwrk;

			// Agencia
			$this->Agencia->EditAttrs["class"] = "form-control";
			$this->Agencia->EditCustomAttributes = "";
			$this->Agencia->EditValue = ew_HtmlEncode($this->Agencia->CurrentValue);

			// Conta
			$this->Conta->EditAttrs["class"] = "form-control";
			$this->Conta->EditCustomAttributes = "";
			$this->Conta->EditValue = ew_HtmlEncode($this->Conta->CurrentValue);

			// Gerente
			$this->Gerente->EditAttrs["class"] = "form-control";
			$this->Gerente->EditCustomAttributes = "";
			$this->Gerente->EditValue = ew_HtmlEncode($this->Gerente->CurrentValue);

			// Telefone
			$this->Telefone->EditAttrs["class"] = "form-control";
			$this->Telefone->EditCustomAttributes = "";
			$this->Telefone->EditValue = ew_HtmlEncode($this->Telefone->CurrentValue);

			// Limite
			$this->Limite->EditAttrs["class"] = "form-control";
			$this->Limite->EditCustomAttributes = "";
			$this->Limite->EditValue = ew_HtmlEncode($this->Limite->CurrentValue);
			if (strval($this->Limite->EditValue) <> "" && is_numeric($this->Limite->EditValue)) $this->Limite->EditValue = ew_FormatNumber($this->Limite->EditValue, -2, -1, -2, 0);

			// Site
			$this->Site->EditAttrs["class"] = "form-control";
			$this->Site->EditCustomAttributes = "";
			$this->Site->EditValue = ew_HtmlEncode($this->Site->CurrentValue);

			// Edit refer script
			// Id

			$this->Id->HrefValue = "";

			// Banco
			$this->Banco->HrefValue = "";

			// Agencia
			$this->Agencia->HrefValue = "";

			// Conta
			$this->Conta->HrefValue = "";

			// Gerente
			$this->Gerente->HrefValue = "";

			// Telefone
			$this->Telefone->HrefValue = "";

			// Limite
			$this->Limite->HrefValue = "";

			// Site
			$this->Site->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->Banco->FldIsDetailKey && !is_null($this->Banco->FormValue) && $this->Banco->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Banco->FldCaption(), $this->Banco->ReqErrMsg));
		}
		if (!$this->Agencia->FldIsDetailKey && !is_null($this->Agencia->FormValue) && $this->Agencia->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Agencia->FldCaption(), $this->Agencia->ReqErrMsg));
		}
		if (!$this->Conta->FldIsDetailKey && !is_null($this->Conta->FormValue) && $this->Conta->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Conta->FldCaption(), $this->Conta->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Limite->FormValue)) {
			ew_AddMessage($gsFormError, $this->Limite->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// Banco
			$this->Banco->SetDbValueDef($rsnew, $this->Banco->CurrentValue, NULL, $this->Banco->ReadOnly);

			// Agencia
			$this->Agencia->SetDbValueDef($rsnew, $this->Agencia->CurrentValue, NULL, $this->Agencia->ReadOnly);

			// Conta
			$this->Conta->SetDbValueDef($rsnew, $this->Conta->CurrentValue, NULL, $this->Conta->ReadOnly);

			// Gerente
			$this->Gerente->SetDbValueDef($rsnew, $this->Gerente->CurrentValue, NULL, $this->Gerente->ReadOnly);

			// Telefone
			$this->Telefone->SetDbValueDef($rsnew, $this->Telefone->CurrentValue, NULL, $this->Telefone->ReadOnly);

			// Limite
			$this->Limite->SetDbValueDef($rsnew, $this->Limite->CurrentValue, NULL, $this->Limite->ReadOnly);

			// Site
			$this->Site->SetDbValueDef($rsnew, $this->Site->CurrentValue, NULL, $this->Site->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, "conta_bancarialist.php", "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'conta_bancaria';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		if (!$this->AuditTrailOnEdit) return;
		$table = 'conta_bancaria';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['Id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	function Page_DataRendering(&$header) {

		//$header = $this->setMessage("your header");
	}

	function Page_DataRendered(&$footer) {

		//$footer = $this->setMessage("your footer");
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(TRUE) ?>
<?php

// Create page object
if (!isset($conta_bancaria_edit)) $conta_bancaria_edit = new cconta_bancaria_edit();

// Page init
$conta_bancaria_edit->Page_Init();

// Page main
$conta_bancaria_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$conta_bancaria_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var conta_bancaria_edit = new ew_Page("conta_bancaria_edit");
conta_bancaria_edit.PageID = "edit"; // Page ID
var EW_PAGE_ID = conta_bancaria_edit.PageID; // For backward compatibility

// Form object
var fconta_bancariaedit = new ew_Form("fconta_bancariaedit");

// Validate form
fconta_bancariaedit.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	this.PostAutoSuggest();
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_Banco");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $conta_bancaria->Banco->FldCaption(), $conta_bancaria->Banco->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Agencia");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $conta_bancaria->Agencia->FldCaption(), $conta_bancaria->Agencia->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Conta");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $conta_bancaria->Conta->FldCaption(), $conta_bancaria->Conta->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Limite");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($conta_bancaria->Limite->FldErrMsg()) ?>");

			// Set up row object
			ew_ElementsToRow(fobj);

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fconta_bancariaedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fconta_bancariaedit.ValidateRequired = true;
<?php } else { ?>
fconta_bancariaedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fconta_bancariaedit.Lists["x_Banco"] = {"LinkField":"x_id","Ajax":null,"AutoFill":false,"DisplayFields":["x_N_do_Banco","x_Banco","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $conta_bancaria_edit->ShowPageHeader(); ?>
<?php
$conta_bancaria_edit->ShowMessage();
?>
<form name="fconta_bancariaedit" id="fconta_bancariaedit" class="form-horizontal ewForm ewEditForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($conta_bancaria_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $conta_bancaria_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="conta_bancaria">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<div>
<?php if ($conta_bancaria->Banco->Visible) { // Banco ?>
	<div id="r_Banco" class="form-group">
		<label id="elh_conta_bancaria_Banco" for="x_Banco" class="col-sm-2 control-label ewLabel"><?php echo $conta_bancaria->Banco->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $conta_bancaria->Banco->CellAttributes() ?>>
<span id="el_conta_bancaria_Banco">
<select data-field="x_Banco" id="x_Banco" name="x_Banco"<?php echo $conta_bancaria->Banco->EditAttributes() ?>>
<?php
if (is_array($conta_bancaria->Banco->EditValue)) {
	$arwrk = $conta_bancaria->Banco->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($conta_bancaria->Banco->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator(1,$conta_bancaria->Banco) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php if (AllowAdd(CurrentProjectID() . "bancos")) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $conta_bancaria->Banco->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_Banco',url:'bancosaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_Banco"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $conta_bancaria->Banco->FldCaption() ?></span></button>
<?php } ?>
<script type="text/javascript">
fconta_bancariaedit.Lists["x_Banco"].Options = <?php echo (is_array($conta_bancaria->Banco->EditValue)) ? ew_ArrayToJson($conta_bancaria->Banco->EditValue, 1) : "[]" ?>;
</script>
</span>
<?php echo $conta_bancaria->Banco->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($conta_bancaria->Agencia->Visible) { // Agencia ?>
	<div id="r_Agencia" class="form-group">
		<label id="elh_conta_bancaria_Agencia" for="x_Agencia" class="col-sm-2 control-label ewLabel"><?php echo $conta_bancaria->Agencia->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $conta_bancaria->Agencia->CellAttributes() ?>>
<span id="el_conta_bancaria_Agencia">
<input type="text" data-field="x_Agencia" name="x_Agencia" id="x_Agencia" size="5" maxlength="10" value="<?php echo $conta_bancaria->Agencia->EditValue ?>"<?php echo $conta_bancaria->Agencia->EditAttributes() ?>>
</span>
<?php echo $conta_bancaria->Agencia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($conta_bancaria->Conta->Visible) { // Conta ?>
	<div id="r_Conta" class="form-group">
		<label id="elh_conta_bancaria_Conta" for="x_Conta" class="col-sm-2 control-label ewLabel"><?php echo $conta_bancaria->Conta->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $conta_bancaria->Conta->CellAttributes() ?>>
<span id="el_conta_bancaria_Conta">
<input type="text" data-field="x_Conta" name="x_Conta" id="x_Conta" size="10" maxlength="20" value="<?php echo $conta_bancaria->Conta->EditValue ?>"<?php echo $conta_bancaria->Conta->EditAttributes() ?>>
</span>
<?php echo $conta_bancaria->Conta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($conta_bancaria->Gerente->Visible) { // Gerente ?>
	<div id="r_Gerente" class="form-group">
		<label id="elh_conta_bancaria_Gerente" for="x_Gerente" class="col-sm-2 control-label ewLabel"><?php echo $conta_bancaria->Gerente->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $conta_bancaria->Gerente->CellAttributes() ?>>
<span id="el_conta_bancaria_Gerente">
<input type="text" data-field="x_Gerente" name="x_Gerente" id="x_Gerente" size="30" maxlength="40" value="<?php echo $conta_bancaria->Gerente->EditValue ?>"<?php echo $conta_bancaria->Gerente->EditAttributes() ?>>
</span>
<?php echo $conta_bancaria->Gerente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($conta_bancaria->Telefone->Visible) { // Telefone ?>
	<div id="r_Telefone" class="form-group">
		<label id="elh_conta_bancaria_Telefone" for="x_Telefone" class="col-sm-2 control-label ewLabel"><?php echo $conta_bancaria->Telefone->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $conta_bancaria->Telefone->CellAttributes() ?>>
<span id="el_conta_bancaria_Telefone">
<input type="text" data-field="x_Telefone" name="x_Telefone" id="x_Telefone" size="15" maxlength="50" value="<?php echo $conta_bancaria->Telefone->EditValue ?>"<?php echo $conta_bancaria->Telefone->EditAttributes() ?>>
</span>
<?php echo $conta_bancaria->Telefone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($conta_bancaria->Limite->Visible) { // Limite ?>
	<div id="r_Limite" class="form-group">
		<label id="elh_conta_bancaria_Limite" for="x_Limite" class="col-sm-2 control-label ewLabel"><?php echo $conta_bancaria->Limite->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $conta_bancaria->Limite->CellAttributes() ?>>
<span id="el_conta_bancaria_Limite">
<input type="text" data-field="x_Limite" name="x_Limite" id="x_Limite" size="15" value="<?php echo $conta_bancaria->Limite->EditValue ?>"<?php echo $conta_bancaria->Limite->EditAttributes() ?>>
</span>
<?php echo $conta_bancaria->Limite->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($conta_bancaria->Site->Visible) { // Site ?>
	<div id="r_Site" class="form-group">
		<label id="elh_conta_bancaria_Site" for="x_Site" class="col-sm-2 control-label ewLabel"><?php echo $conta_bancaria->Site->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $conta_bancaria->Site->CellAttributes() ?>>
<span id="el_conta_bancaria_Site">
<input type="text" data-field="x_Site" name="x_Site" id="x_Site" size="40" maxlength="50" value="<?php echo $conta_bancaria->Site->EditValue ?>"<?php echo $conta_bancaria->Site->EditAttributes() ?>>
</span>
<?php echo $conta_bancaria->Site->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<span id="el_conta_bancaria_Id">
<input type="hidden" data-field="x_Id" name="x_Id" id="x_Id" value="<?php echo ew_HtmlEncode($conta_bancaria->Id->CurrentValue) ?>">
</span>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;<?php echo $Language->Phrase("SaveBtn") ?></button>
	</div>
</div>
</form>
<script type="text/javascript">
fconta_bancariaedit.Init();
</script>
<?php
$conta_bancaria_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$conta_bancaria_edit->Page_Terminate();
?>
