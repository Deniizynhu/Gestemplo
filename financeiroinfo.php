<?php

// Global variable for table object
$financeiro = NULL;

//
// Table class for financeiro
//
class cfinanceiro extends cTable {
	var $Id;
	var $Tipo;
	var $Tipo_Recebimento;
	var $FormaPagto;
	var $Conta_Caixa;
	var $Situacao;
	var $Descricao;
	var $id_discipulo;
	var $Receitas;
	var $Despesas;
	var $N_Documento;
	var $Dt_Lancamento;
	var $Vencimento;
	var $Centro_de_Custo;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'financeiro';
		$this->TableName = 'financeiro';
		$this->TableType = 'TABLE';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// Id
		$this->Id = new cField('financeiro', 'financeiro', 'x_Id', 'Id', '`Id`', '`Id`', 3, -1, FALSE, '`Id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Id'] = &$this->Id;

		// Tipo
		$this->Tipo = new cField('financeiro', 'financeiro', 'x_Tipo', 'Tipo', '`Tipo`', '`Tipo`', 16, -1, FALSE, '`Tipo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Tipo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Tipo'] = &$this->Tipo;

		// Tipo_Recebimento
		$this->Tipo_Recebimento = new cField('financeiro', 'financeiro', 'x_Tipo_Recebimento', 'Tipo_Recebimento', '`Tipo_Recebimento`', '`Tipo_Recebimento`', 16, -1, FALSE, '`Tipo_Recebimento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Tipo_Recebimento->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Tipo_Recebimento'] = &$this->Tipo_Recebimento;

		// FormaPagto
		$this->FormaPagto = new cField('financeiro', 'financeiro', 'x_FormaPagto', 'FormaPagto', '`FormaPagto`', '`FormaPagto`', 16, -1, FALSE, '`FormaPagto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->FormaPagto->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['FormaPagto'] = &$this->FormaPagto;

		// Conta_Caixa
		$this->Conta_Caixa = new cField('financeiro', 'financeiro', 'x_Conta_Caixa', 'Conta_Caixa', '`Conta_Caixa`', '`Conta_Caixa`', 3, -1, FALSE, '`Conta_Caixa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Conta_Caixa->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Conta_Caixa'] = &$this->Conta_Caixa;

		// Situacao
		$this->Situacao = new cField('financeiro', 'financeiro', 'x_Situacao', 'Situacao', '`Situacao`', '`Situacao`', 16, -1, FALSE, '`Situacao`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Situacao->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Situacao'] = &$this->Situacao;

		// Descricao
		$this->Descricao = new cField('financeiro', 'financeiro', 'x_Descricao', 'Descricao', '`Descricao`', '`Descricao`', 200, -1, FALSE, '`Descricao`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['Descricao'] = &$this->Descricao;

		// id_discipulo
		$this->id_discipulo = new cField('financeiro', 'financeiro', 'x_id_discipulo', 'id_discipulo', '`id_discipulo`', '`id_discipulo`', 3, -1, FALSE, '`id_discipulo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->id_discipulo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_discipulo'] = &$this->id_discipulo;

		// Receitas
		$this->Receitas = new cField('financeiro', 'financeiro', 'x_Receitas', 'Receitas', '`Receitas`', '`Receitas`', 131, -1, FALSE, '`Receitas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Receitas->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Receitas'] = &$this->Receitas;

		// Despesas
		$this->Despesas = new cField('financeiro', 'financeiro', 'x_Despesas', 'Despesas', '`Despesas`', '`Despesas`', 131, -1, FALSE, '`Despesas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Despesas->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Despesas'] = &$this->Despesas;

		// N_Documento
		$this->N_Documento = new cField('financeiro', 'financeiro', 'x_N_Documento', 'N_Documento', '`N_Documento`', '`N_Documento`', 200, -1, FALSE, '`N_Documento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['N_Documento'] = &$this->N_Documento;

		// Dt_Lancamento
		$this->Dt_Lancamento = new cField('financeiro', 'financeiro', 'x_Dt_Lancamento', 'Dt_Lancamento', '`Dt_Lancamento`', 'DATE_FORMAT(`Dt_Lancamento`, \'%d/%m/%Y\')', 133, 7, FALSE, '`Dt_Lancamento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Dt_Lancamento->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['Dt_Lancamento'] = &$this->Dt_Lancamento;

		// Vencimento
		$this->Vencimento = new cField('financeiro', 'financeiro', 'x_Vencimento', 'Vencimento', '`Vencimento`', 'DATE_FORMAT(`Vencimento`, \'%d/%m/%Y\')', 133, 7, FALSE, '`Vencimento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Vencimento->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['Vencimento'] = &$this->Vencimento;

		// Centro_de_Custo
		$this->Centro_de_Custo = new cField('financeiro', 'financeiro', 'x_Centro_de_Custo', 'Centro_de_Custo', '`Centro_de_Custo`', '`Centro_de_Custo`', 3, -1, FALSE, '`Centro_de_Custo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Centro_de_Custo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Centro_de_Custo'] = &$this->Centro_de_Custo;
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`financeiro`";
	}

	function SqlFrom() { // For backward compatibility
    	return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
    	$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
    	return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
    	$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
    	return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
    	$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
    	return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
    	$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
    	return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
    	$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`Dt_Lancamento` DESC";
	}

	function SqlOrderBy() { // For backward compatibility
    	return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
    	$this->_SqlOrderBy = $v;
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (@$this->PageID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Update Table
	var $UpdateTable = "`financeiro`";

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]))
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		global $conn;
		return $conn->Execute($this->InsertSQL($rs));
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "") {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]))
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = $this->CurrentFilter;
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL) {
		global $conn;
		return $conn->Execute($this->UpdateSQL($rs, $where));
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "") {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if ($rs) {
			if (array_key_exists('Id', $rs))
				ew_AddFilter($where, ew_QuotedName('Id') . '=' . ew_QuotedValue($rs['Id'], $this->Id->FldDataType));
		}
		$filter = $this->CurrentFilter;
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "") {
		global $conn;
		return $conn->Execute($this->DeleteSQL($rs, $where));
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`Id` = @Id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->Id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@Id@", ew_AdjustSql($this->Id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "financeirolist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "financeirolist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("financeiroview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("financeiroview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "financeiroadd.php?" . $this->UrlParm($parm);
		else
			return "financeiroadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("financeiroedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("financeiroadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("financeirodelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->Id->CurrentValue)) {
			$sUrl .= "Id=" . urlencode($this->Id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["Id"]; // Id

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
				continue;
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->Id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->Id->setDbValue($rs->fields('Id'));
		$this->Tipo->setDbValue($rs->fields('Tipo'));
		$this->Tipo_Recebimento->setDbValue($rs->fields('Tipo_Recebimento'));
		$this->FormaPagto->setDbValue($rs->fields('FormaPagto'));
		$this->Conta_Caixa->setDbValue($rs->fields('Conta_Caixa'));
		$this->Situacao->setDbValue($rs->fields('Situacao'));
		$this->Descricao->setDbValue($rs->fields('Descricao'));
		$this->id_discipulo->setDbValue($rs->fields('id_discipulo'));
		$this->Receitas->setDbValue($rs->fields('Receitas'));
		$this->Despesas->setDbValue($rs->fields('Despesas'));
		$this->N_Documento->setDbValue($rs->fields('N_Documento'));
		$this->Dt_Lancamento->setDbValue($rs->fields('Dt_Lancamento'));
		$this->Vencimento->setDbValue($rs->fields('Vencimento'));
		$this->Centro_de_Custo->setDbValue($rs->fields('Centro_de_Custo'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// Id

		$this->Id->CellCssStyle = "white-space: nowrap;";

		// Tipo
		// Tipo_Recebimento

		$this->Tipo_Recebimento->CellCssStyle = "white-space: nowrap;";

		// FormaPagto
		// Conta_Caixa
		// Situacao
		// Descricao
		// id_discipulo

		$this->id_discipulo->CellCssStyle = "white-space: nowrap;";

		// Receitas
		// Despesas
		// N_Documento
		// Dt_Lancamento
		// Vencimento
		// Centro_de_Custo
		// Id

		$this->Id->ViewValue = $this->Id->CurrentValue;
		$this->Id->ViewCustomAttributes = "";

		// Tipo
		if (strval($this->Tipo->CurrentValue) <> "") {
			switch ($this->Tipo->CurrentValue) {
				case $this->Tipo->FldTagValue(1):
					$this->Tipo->ViewValue = $this->Tipo->FldTagCaption(1) <> "" ? $this->Tipo->FldTagCaption(1) : $this->Tipo->CurrentValue;
					break;
				case $this->Tipo->FldTagValue(2):
					$this->Tipo->ViewValue = $this->Tipo->FldTagCaption(2) <> "" ? $this->Tipo->FldTagCaption(2) : $this->Tipo->CurrentValue;
					break;
				default:
					$this->Tipo->ViewValue = $this->Tipo->CurrentValue;
			}
		} else {
			$this->Tipo->ViewValue = NULL;
		}
		$this->Tipo->ViewCustomAttributes = "";

		// Tipo_Recebimento
		if (strval($this->Tipo_Recebimento->CurrentValue) <> "") {
			switch ($this->Tipo_Recebimento->CurrentValue) {
				case $this->Tipo_Recebimento->FldTagValue(1):
					$this->Tipo_Recebimento->ViewValue = $this->Tipo_Recebimento->FldTagCaption(1) <> "" ? $this->Tipo_Recebimento->FldTagCaption(1) : $this->Tipo_Recebimento->CurrentValue;
					break;
				case $this->Tipo_Recebimento->FldTagValue(2):
					$this->Tipo_Recebimento->ViewValue = $this->Tipo_Recebimento->FldTagCaption(2) <> "" ? $this->Tipo_Recebimento->FldTagCaption(2) : $this->Tipo_Recebimento->CurrentValue;
					break;
				default:
					$this->Tipo_Recebimento->ViewValue = $this->Tipo_Recebimento->CurrentValue;
			}
		} else {
			$this->Tipo_Recebimento->ViewValue = NULL;
		}
		$this->Tipo_Recebimento->CellCssStyle .= "text-align: center;";
		$this->Tipo_Recebimento->ViewCustomAttributes = "";

		// FormaPagto
		if (strval($this->FormaPagto->CurrentValue) <> "") {
			$sFilterWrk = "`Id`" . ew_SearchString("=", $this->FormaPagto->CurrentValue, EW_DATATYPE_NUMBER);
		$sSqlWrk = "SELECT `Id`, `Forma_Pagto` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `fin_forma_pgto`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			ew_AddFilter($sWhereWrk, $sFilterWrk);
		}

		// Call Lookup selecting
		$this->Lookup_Selecting($this->FormaPagto, $sWhereWrk);
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Forma_Pagto` ASC";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->FormaPagto->ViewValue = $rswrk->fields('DispFld');
				$rswrk->Close();
			} else {
				$this->FormaPagto->ViewValue = $this->FormaPagto->CurrentValue;
			}
		} else {
			$this->FormaPagto->ViewValue = NULL;
		}
		$this->FormaPagto->ViewCustomAttributes = "";

		// Conta_Caixa
		if (strval($this->Conta_Caixa->CurrentValue) <> "") {
			$sFilterWrk = "`Id`" . ew_SearchString("=", $this->Conta_Caixa->CurrentValue, EW_DATATYPE_NUMBER);
		$sSqlWrk = "SELECT `Id`, `Conta_Caixa` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `fin_conta_caixa`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			ew_AddFilter($sWhereWrk, $sFilterWrk);
		}

		// Call Lookup selecting
		$this->Lookup_Selecting($this->Conta_Caixa, $sWhereWrk);
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Conta_Caixa->ViewValue = $rswrk->fields('DispFld');
				$rswrk->Close();
			} else {
				$this->Conta_Caixa->ViewValue = $this->Conta_Caixa->CurrentValue;
			}
		} else {
			$this->Conta_Caixa->ViewValue = NULL;
		}
		$this->Conta_Caixa->ViewCustomAttributes = "";

		// Situacao
		if (strval($this->Situacao->CurrentValue) <> "") {
			$sFilterWrk = "`Id`" . ew_SearchString("=", $this->Situacao->CurrentValue, EW_DATATYPE_NUMBER);
		$sSqlWrk = "SELECT `Id`, `Situacao` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `fin_situacao`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			ew_AddFilter($sWhereWrk, $sFilterWrk);
		}

		// Call Lookup selecting
		$this->Lookup_Selecting($this->Situacao, $sWhereWrk);
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Situacao->ViewValue = $rswrk->fields('DispFld');
				$rswrk->Close();
			} else {
				$this->Situacao->ViewValue = $this->Situacao->CurrentValue;
			}
		} else {
			$this->Situacao->ViewValue = NULL;
		}
		$this->Situacao->CellCssStyle .= "text-align: center;";
		$this->Situacao->ViewCustomAttributes = "";

		// Descricao
		$this->Descricao->ViewValue = $this->Descricao->CurrentValue;
		$this->Descricao->ViewCustomAttributes = "";

		// id_discipulo
		if (strval($this->id_discipulo->CurrentValue) <> "") {
			$sFilterWrk = "`Id_membro`" . ew_SearchString("=", $this->id_discipulo->CurrentValue, EW_DATATYPE_NUMBER);
		$sSqlWrk = "SELECT `Id_membro`, `Nome` AS `DispFld`, `CPF` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `membro`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			ew_AddFilter($sWhereWrk, $sFilterWrk);
		}

		// Call Lookup selecting
		$this->Lookup_Selecting($this->id_discipulo, $sWhereWrk);
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Nome` ASC";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->id_discipulo->ViewValue = $rswrk->fields('DispFld');
				$this->id_discipulo->ViewValue .= ew_ValueSeparator(1,$this->id_discipulo) . $rswrk->fields('Disp2Fld');
				$rswrk->Close();
			} else {
				$this->id_discipulo->ViewValue = $this->id_discipulo->CurrentValue;
			}
		} else {
			$this->id_discipulo->ViewValue = NULL;
		}
		$this->id_discipulo->ViewCustomAttributes = "";

		// Receitas
		$this->Receitas->ViewValue = $this->Receitas->CurrentValue;
		$this->Receitas->ViewValue = ew_FormatNumber($this->Receitas->ViewValue, 2, -2, -2, -2);
		$this->Receitas->CellCssStyle .= "text-align: right;";
		$this->Receitas->ViewCustomAttributes = "";

		// Despesas
		$this->Despesas->ViewValue = $this->Despesas->CurrentValue;
		$this->Despesas->ViewValue = ew_FormatNumber($this->Despesas->ViewValue, 2, -2, -2, -2);
		$this->Despesas->CellCssStyle .= "text-align: right;";
		$this->Despesas->ViewCustomAttributes = "";

		// N_Documento
		$this->N_Documento->ViewValue = $this->N_Documento->CurrentValue;
		$this->N_Documento->ViewCustomAttributes = "";

		// Dt_Lancamento
		$this->Dt_Lancamento->ViewValue = $this->Dt_Lancamento->CurrentValue;
		$this->Dt_Lancamento->ViewValue = ew_FormatDateTime($this->Dt_Lancamento->ViewValue, 7);
		$this->Dt_Lancamento->ViewCustomAttributes = "";

		// Vencimento
		$this->Vencimento->ViewValue = $this->Vencimento->CurrentValue;
		$this->Vencimento->ViewValue = ew_FormatDateTime($this->Vencimento->ViewValue, 7);
		$this->Vencimento->ViewCustomAttributes = "";

		// Centro_de_Custo
		if (strval($this->Centro_de_Custo->CurrentValue) <> "") {
			$sFilterWrk = "`Id`" . ew_SearchString("=", $this->Centro_de_Custo->CurrentValue, EW_DATATYPE_NUMBER);
		$sSqlWrk = "SELECT `Id`, `Conta` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `fin_centro_de_custo`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			ew_AddFilter($sWhereWrk, $sFilterWrk);
		}

		// Call Lookup selecting
		$this->Lookup_Selecting($this->Centro_de_Custo, $sWhereWrk);
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Conta` ASC";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Centro_de_Custo->ViewValue = $rswrk->fields('DispFld');
				$rswrk->Close();
			} else {
				$this->Centro_de_Custo->ViewValue = $this->Centro_de_Custo->CurrentValue;
			}
		} else {
			$this->Centro_de_Custo->ViewValue = NULL;
		}
		$this->Centro_de_Custo->ViewCustomAttributes = "";

		// Id
		$this->Id->LinkCustomAttributes = "";
		$this->Id->HrefValue = "";
		$this->Id->TooltipValue = "";

		// Tipo
		$this->Tipo->LinkCustomAttributes = "";
		$this->Tipo->HrefValue = "";
		$this->Tipo->TooltipValue = "";

		// Tipo_Recebimento
		$this->Tipo_Recebimento->LinkCustomAttributes = "";
		$this->Tipo_Recebimento->HrefValue = "";
		$this->Tipo_Recebimento->TooltipValue = "";

		// FormaPagto
		$this->FormaPagto->LinkCustomAttributes = "";
		$this->FormaPagto->HrefValue = "";
		$this->FormaPagto->TooltipValue = "";

		// Conta_Caixa
		$this->Conta_Caixa->LinkCustomAttributes = "";
		$this->Conta_Caixa->HrefValue = "";
		$this->Conta_Caixa->TooltipValue = "";

		// Situacao
		$this->Situacao->LinkCustomAttributes = "";
		$this->Situacao->HrefValue = "";
		$this->Situacao->TooltipValue = "";

		// Descricao
		$this->Descricao->LinkCustomAttributes = "";
		$this->Descricao->HrefValue = "";
		$this->Descricao->TooltipValue = "";

		// id_discipulo
		$this->id_discipulo->LinkCustomAttributes = "";
		$this->id_discipulo->HrefValue = "";
		$this->id_discipulo->TooltipValue = "";

		// Receitas
		$this->Receitas->LinkCustomAttributes = "";
		$this->Receitas->HrefValue = "";
		$this->Receitas->TooltipValue = "";

		// Despesas
		$this->Despesas->LinkCustomAttributes = "";
		$this->Despesas->HrefValue = "";
		$this->Despesas->TooltipValue = "";

		// N_Documento
		$this->N_Documento->LinkCustomAttributes = "";
		$this->N_Documento->HrefValue = "";
		$this->N_Documento->TooltipValue = "";

		// Dt_Lancamento
		$this->Dt_Lancamento->LinkCustomAttributes = "";
		$this->Dt_Lancamento->HrefValue = "";
		$this->Dt_Lancamento->TooltipValue = "";

		// Vencimento
		$this->Vencimento->LinkCustomAttributes = "";
		$this->Vencimento->HrefValue = "";
		$this->Vencimento->TooltipValue = "";

		// Centro_de_Custo
		$this->Centro_de_Custo->LinkCustomAttributes = "";
		$this->Centro_de_Custo->HrefValue = "";
		$this->Centro_de_Custo->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $conn, $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Id
		$this->Id->EditAttrs["class"] = "form-control";
		$this->Id->EditCustomAttributes = "";

		// Tipo
		$this->Tipo->EditAttrs["class"] = "form-control";
		$this->Tipo->EditCustomAttributes = "";
		$arwrk = array();
		$arwrk[] = array($this->Tipo->FldTagValue(1), $this->Tipo->FldTagCaption(1) <> "" ? $this->Tipo->FldTagCaption(1) : $this->Tipo->FldTagValue(1));
		$arwrk[] = array($this->Tipo->FldTagValue(2), $this->Tipo->FldTagCaption(2) <> "" ? $this->Tipo->FldTagCaption(2) : $this->Tipo->FldTagValue(2));
		array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
		$this->Tipo->EditValue = $arwrk;

		// Tipo_Recebimento
		$this->Tipo_Recebimento->EditAttrs["class"] = "form-control";
		$this->Tipo_Recebimento->EditCustomAttributes = "";
		$arwrk = array();
		$arwrk[] = array($this->Tipo_Recebimento->FldTagValue(1), $this->Tipo_Recebimento->FldTagCaption(1) <> "" ? $this->Tipo_Recebimento->FldTagCaption(1) : $this->Tipo_Recebimento->FldTagValue(1));
		$arwrk[] = array($this->Tipo_Recebimento->FldTagValue(2), $this->Tipo_Recebimento->FldTagCaption(2) <> "" ? $this->Tipo_Recebimento->FldTagCaption(2) : $this->Tipo_Recebimento->FldTagValue(2));
		array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
		$this->Tipo_Recebimento->EditValue = $arwrk;

		// FormaPagto
		$this->FormaPagto->EditAttrs["class"] = "form-control";
		$this->FormaPagto->EditCustomAttributes = "";

		// Conta_Caixa
		$this->Conta_Caixa->EditAttrs["class"] = "form-control";
		$this->Conta_Caixa->EditCustomAttributes = "";

		// Situacao
		$this->Situacao->EditCustomAttributes = "";

		// Descricao
		$this->Descricao->EditAttrs["class"] = "form-control";
		$this->Descricao->EditCustomAttributes = "";
		$this->Descricao->EditValue = ew_HtmlEncode($this->Descricao->CurrentValue);

		// id_discipulo
		$this->id_discipulo->EditAttrs["class"] = "form-control";
		$this->id_discipulo->EditCustomAttributes = "";

		// Receitas
		$this->Receitas->EditAttrs["class"] = "form-control";
		$this->Receitas->EditCustomAttributes = "";
		$this->Receitas->EditValue = ew_HtmlEncode($this->Receitas->CurrentValue);
		if (strval($this->Receitas->EditValue) <> "" && is_numeric($this->Receitas->EditValue)) $this->Receitas->EditValue = ew_FormatNumber($this->Receitas->EditValue, -2, -2, -2, -2);

		// Despesas
		$this->Despesas->EditAttrs["class"] = "form-control";
		$this->Despesas->EditCustomAttributes = "";
		$this->Despesas->EditValue = ew_HtmlEncode($this->Despesas->CurrentValue);
		if (strval($this->Despesas->EditValue) <> "" && is_numeric($this->Despesas->EditValue)) $this->Despesas->EditValue = ew_FormatNumber($this->Despesas->EditValue, -2, -2, -2, -2);

		// N_Documento
		$this->N_Documento->EditAttrs["class"] = "form-control";
		$this->N_Documento->EditCustomAttributes = "";
		$this->N_Documento->EditValue = ew_HtmlEncode($this->N_Documento->CurrentValue);

		// Dt_Lancamento
		$this->Dt_Lancamento->EditAttrs["class"] = "form-control";
		$this->Dt_Lancamento->EditCustomAttributes = "";
		$this->Dt_Lancamento->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Dt_Lancamento->CurrentValue, 7));

		// Vencimento
		$this->Vencimento->EditAttrs["class"] = "form-control";
		$this->Vencimento->EditCustomAttributes = "";
		$this->Vencimento->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Vencimento->CurrentValue, 7));

		// Centro_de_Custo
		$this->Centro_de_Custo->EditAttrs["class"] = "form-control";
		$this->Centro_de_Custo->EditCustomAttributes = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->Receitas->CurrentValue))
				$this->Receitas->Total += $this->Receitas->CurrentValue; // Accumulate total
			if (is_numeric($this->Despesas->CurrentValue))
				$this->Despesas->Total += $this->Despesas->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
			$this->Receitas->CurrentValue = $this->Receitas->Total;
			$this->Receitas->ViewValue = $this->Receitas->CurrentValue;
			$this->Receitas->ViewValue = ew_FormatNumber($this->Receitas->ViewValue, 2, -2, -2, -2);
			$this->Receitas->CellCssStyle .= "text-align: right;";
			$this->Receitas->ViewCustomAttributes = "";
			$this->Receitas->HrefValue = ""; // Clear href value
			$this->Despesas->CurrentValue = $this->Despesas->Total;
			$this->Despesas->ViewValue = $this->Despesas->CurrentValue;
			$this->Despesas->ViewValue = ew_FormatNumber($this->Despesas->ViewValue, 2, -2, -2, -2);
			$this->Despesas->CellCssStyle .= "text-align: right;";
			$this->Despesas->ViewCustomAttributes = "";
			$this->Despesas->HrefValue = ""; // Clear href value
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->Tipo->Exportable) $Doc->ExportCaption($this->Tipo);
					if ($this->Tipo_Recebimento->Exportable) $Doc->ExportCaption($this->Tipo_Recebimento);
					if ($this->FormaPagto->Exportable) $Doc->ExportCaption($this->FormaPagto);
					if ($this->Conta_Caixa->Exportable) $Doc->ExportCaption($this->Conta_Caixa);
					if ($this->Situacao->Exportable) $Doc->ExportCaption($this->Situacao);
					if ($this->Descricao->Exportable) $Doc->ExportCaption($this->Descricao);
					if ($this->id_discipulo->Exportable) $Doc->ExportCaption($this->id_discipulo);
					if ($this->Receitas->Exportable) $Doc->ExportCaption($this->Receitas);
					if ($this->Despesas->Exportable) $Doc->ExportCaption($this->Despesas);
					if ($this->N_Documento->Exportable) $Doc->ExportCaption($this->N_Documento);
					if ($this->Dt_Lancamento->Exportable) $Doc->ExportCaption($this->Dt_Lancamento);
					if ($this->Vencimento->Exportable) $Doc->ExportCaption($this->Vencimento);
					if ($this->Centro_de_Custo->Exportable) $Doc->ExportCaption($this->Centro_de_Custo);
				} else {
					if ($this->Tipo->Exportable) $Doc->ExportCaption($this->Tipo);
					if ($this->Tipo_Recebimento->Exportable) $Doc->ExportCaption($this->Tipo_Recebimento);
					if ($this->FormaPagto->Exportable) $Doc->ExportCaption($this->FormaPagto);
					if ($this->Conta_Caixa->Exportable) $Doc->ExportCaption($this->Conta_Caixa);
					if ($this->Situacao->Exportable) $Doc->ExportCaption($this->Situacao);
					if ($this->Descricao->Exportable) $Doc->ExportCaption($this->Descricao);
					if ($this->id_discipulo->Exportable) $Doc->ExportCaption($this->id_discipulo);
					if ($this->Receitas->Exportable) $Doc->ExportCaption($this->Receitas);
					if ($this->Despesas->Exportable) $Doc->ExportCaption($this->Despesas);
					if ($this->N_Documento->Exportable) $Doc->ExportCaption($this->N_Documento);
					if ($this->Dt_Lancamento->Exportable) $Doc->ExportCaption($this->Dt_Lancamento);
					if ($this->Vencimento->Exportable) $Doc->ExportCaption($this->Vencimento);
					if ($this->Centro_de_Custo->Exportable) $Doc->ExportCaption($this->Centro_de_Custo);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);
				$this->AggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->Tipo->Exportable) $Doc->ExportField($this->Tipo);
						if ($this->Tipo_Recebimento->Exportable) $Doc->ExportField($this->Tipo_Recebimento);
						if ($this->FormaPagto->Exportable) $Doc->ExportField($this->FormaPagto);
						if ($this->Conta_Caixa->Exportable) $Doc->ExportField($this->Conta_Caixa);
						if ($this->Situacao->Exportable) $Doc->ExportField($this->Situacao);
						if ($this->Descricao->Exportable) $Doc->ExportField($this->Descricao);
						if ($this->id_discipulo->Exportable) $Doc->ExportField($this->id_discipulo);
						if ($this->Receitas->Exportable) $Doc->ExportField($this->Receitas);
						if ($this->Despesas->Exportable) $Doc->ExportField($this->Despesas);
						if ($this->N_Documento->Exportable) $Doc->ExportField($this->N_Documento);
						if ($this->Dt_Lancamento->Exportable) $Doc->ExportField($this->Dt_Lancamento);
						if ($this->Vencimento->Exportable) $Doc->ExportField($this->Vencimento);
						if ($this->Centro_de_Custo->Exportable) $Doc->ExportField($this->Centro_de_Custo);
					} else {
						if ($this->Tipo->Exportable) $Doc->ExportField($this->Tipo);
						if ($this->Tipo_Recebimento->Exportable) $Doc->ExportField($this->Tipo_Recebimento);
						if ($this->FormaPagto->Exportable) $Doc->ExportField($this->FormaPagto);
						if ($this->Conta_Caixa->Exportable) $Doc->ExportField($this->Conta_Caixa);
						if ($this->Situacao->Exportable) $Doc->ExportField($this->Situacao);
						if ($this->Descricao->Exportable) $Doc->ExportField($this->Descricao);
						if ($this->id_discipulo->Exportable) $Doc->ExportField($this->id_discipulo);
						if ($this->Receitas->Exportable) $Doc->ExportField($this->Receitas);
						if ($this->Despesas->Exportable) $Doc->ExportField($this->Despesas);
						if ($this->N_Documento->Exportable) $Doc->ExportField($this->N_Documento);
						if ($this->Dt_Lancamento->Exportable) $Doc->ExportField($this->Dt_Lancamento);
						if ($this->Vencimento->Exportable) $Doc->ExportField($this->Vencimento);
						if ($this->Centro_de_Custo->Exportable) $Doc->ExportField($this->Centro_de_Custo);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}

		// Export aggregates (horizontal format only)
		if ($Doc->Horizontal) {
			$this->RowType = EW_ROWTYPE_AGGREGATE;
			$this->ResetAttrs();
			$this->AggregateListRow();
			if (!$Doc->ExportCustom) {
				$Doc->BeginExportRow(-1);
				$Doc->ExportAggregate($this->Tipo, '');
				$Doc->ExportAggregate($this->Tipo_Recebimento, '');
				$Doc->ExportAggregate($this->FormaPagto, '');
				$Doc->ExportAggregate($this->Conta_Caixa, '');
				$Doc->ExportAggregate($this->Situacao, '');
				$Doc->ExportAggregate($this->Descricao, '');
				$Doc->ExportAggregate($this->id_discipulo, '');
				$Doc->ExportAggregate($this->Receitas, 'TOTAL');
				$Doc->ExportAggregate($this->Despesas, 'TOTAL');
				$Doc->ExportAggregate($this->N_Documento, '');
				$Doc->ExportAggregate($this->Dt_Lancamento, '');
				$Doc->ExportAggregate($this->Vencimento, '');
				$Doc->ExportAggregate($this->Centro_de_Custo, '');
				$Doc->EndExportRow();
			}
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
	if ($rsnew["Tipo"] == 1){ /*receita*/
			$rsnew["Despesas"] = null;
	} else {
			$rsnew["Receitas"] = null;
	}
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
