<?php
   header('Content-type:application/xls');
   header('Content-Disposition: attachment; filename=factura.xml');

   require_once('conexion.php');
   $conn=new Conexion();
   $link = $conn->conectarse();


   
?>

<?xml version="1.0" encoding="UTF-8" standalone="no"?><Invoice 
xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" 
xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" 
xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" 
xmlns:ds="http://www.w3.org/2000/09/xmldsig#" 
xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" 
xmlns:sts="dian:gov:co:facturaelectronica:Structures-2-1" 
xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" 
xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" 
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2     http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-Invoice-2.1.xsd">
   <ext:UBLExtensions>
      <ext:UBLExtension>
         <ext:ExtensionContent>
            <sts:DianExtensions>
               <sts:InvoiceControl>
                  <sts:InvoiceAuthorization><?php echo $noResolucion; ?></sts:InvoiceAuthorization>
                  <sts:AuthorizationPeriod>
                     <cbc:StartDate><?php echo $inicioFecha; ?></cbc:StartDate>
                     <cbc:EndDate><?php echo $finFecha; ?></cbc:EndDate>
                  </sts:AuthorizationPeriod>
                  <sts:AuthorizedInvoices>
                     <sts:Prefix><?php echo $Prefix; ?></sts:Prefix>
                     <sts:From><?php echo $desde; ?></sts:From>
                     <sts:To><?php echo $hasta; ?></sts:To>
                  </sts:AuthorizedInvoices>
               </sts:InvoiceControl>

               <sts:InvoiceSource>
                  <cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.1">CO</cbc:IdentificationCode>
               </sts:InvoiceSource>

               <sts:SoftwareProvider>
                  <sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31"><?php echo $CompanyNIT; ?></sts:ProviderID>
                  <sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"><?php echo $idSoftware; ?></sts:SoftwareID>
               </sts:SoftwareProvider>

               <sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"><?php echo $codigoSeguridadSoftware; ?></sts:SoftwareSecurityCode>

               <sts:AuthorizationProvider>
                  <sts:AuthorizationProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31"><?php echo $nitDian; ?></sts:AuthorizationProviderID>
               </sts:AuthorizationProvider>

               <sts:QRCode><?php echo $qrCode; ?></sts:QRCode>
            </sts:DianExtensions>
         </ext:ExtensionContent>
      </ext:UBLExtension>

      <ext:UBLExtensions>
       <ext:ExtensionContent>
         
       </ext:ExtensionContent>
       </ext:UBLExtensions>

   </ext:UBLExtensions>




   <cbc:UBLVersionID>UBL 2.1</cbc:UBLVersionID>
   <cbc:CustomizationID><?php echo $idPersonalizar; ?></cbc:CustomizationID>
   <cbc:ProfileID>DIAN 2.1</cbc:ProfileID>
   <cbc:ProfileExecutionID><?php echo $idPerfilEjecucion; ?></cbc:ProfileExecutionID>
   <cbc:ID><?php echo $id; ?></cbc:ID>
   <cbc:UUID schemeID="2" schemeName="CUFE-SHA384"><?php echo $UUID; ?></cbc:UUID>
   <cbc:IssueDate><?php echo $IssueDate; ?></cbc:IssueDate>
   <cbc:IssueTime><?php echo $IssueTime; ?></cbc:IssueTime>
   <cbc:InvoiceTypeCode><?php echo $InvoiceTypeCode; ?></cbc:InvoiceTypeCode>

   <cbc:Note> NOTA: </cbc:Note>

   <cbc:DocumentCurrencyCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listID="ISO 4217 Alpha">COP</cbc:DocumentCurrencyCode>

   <cbc:LineCountNumeric><?php echo $LineCountNumeric; ?></cbc:LineCountNumeric>

   <cac:InvoicePeriod>
      <cbc:StartDate><?php echo $InvoicePeriodStartDate; ?></cbc:StartDate>
      <cbc:EndDate><?php echo $InvoicePeriodEndDate; ?></cbc:EndDate>
   </cac:InvoicePeriod>


   <cac:AccountingSupplierParty>
      <cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>
      <cac:Party>
         <cbc:IndustryClasificationCode><?php echo $IndustryClasificationCode; ?></cbc:IndustryClasificationCode>
         <cac:PartyName>
            <cbc:Name><?php echo $CompanyName; ?></cbc:Name>
         </cac:PartyName>

         <cac:PhysicalLocation>
            <cac:Address>
               <cbc:ID><?php echo $CompanyPostCode; ?></cbc:ID>
               <cbc:CityName><?php echo $CompanyCity; ?></cbc:CityName>
               <cbc:CountrySubentity><?php echo $CompanyDepto; ?></cbc:CountrySubentity>
               <cbc:CountrySubentityCode><?php echo $CompanyDeptoCode; ?></cbc:CountrySubentityCode>
               <cac:AddressLine>
                  <cbc:Line><?php echo $CompanyAddress; ?></cbc:Line>
               </cac:AddressLine>
               <cac:Country>
                  <cbc:IdentificationCode>CO</cbc:IdentificationCode>
                  <cbc:Name languageID="es">Colombia</cbc:Name>
               </cac:Country>
            </cac:Address>
         </cac:PhysicalLocation>

         <cac:PartyTaxScheme>
            <cbc:RegistrationName><?php echo $CompanyName; ?></cbc:RegistrationName>
            <cbc:CompanyID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31"><?php echo $CompanyNIT; ?></cbc:CompanyID>
            <cbc:TaxLevelCode listName="05"><?php echo $TaxLevelCode; ?></cbc:TaxLevelCode>
            <cac:RegistrationAddress>

            </cac:RegistrationAddress>
            <cac:TaxScheme>
               <cbc:ID><?php echo $TaxSchemeID; ?></cbc:ID>
               <cbc:Name><?php echo $TaxSchemeName; ?></cbc:Name>
            </cac:TaxScheme>
         </cac:PartyTaxScheme>

         <cac:PartyLegalEntity>
            <cbc:RegistrationName><?php echo $CompanyName; ?></cbc:RegistrationName>
            <cbc:CompanyID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="9" schemeName="31"><?php echo $CompanyNIT; ?></cbc:CompanyID>
         </cac:PartyLegalEntity>
      </cac:Party>
   </cac:AccountingSupplierParty>

   <cac:AccountingCustomerParty>
      <cbc:AdditionalAccountID><?php echo $AdditionalAccountID; ?></cbc:AdditionalAccountID>
      <cac:Party>
         <cac:PartyName>
            <cbc:Name><?php echo $CustomerName; ?></cbc:Name>
         </cac:PartyName>
         <cac:PhysicalLocation>
            <cac:Address>
               <cbc:ID><?php echo $CustomerCityCode; ?></cbc:ID>
               <cbc:CityName><?php echo $CustomerCity; ?></cbc:CityName>
               <cbc:CountrySubentity><?php echo $CustomerDepto; ?></cbc:CountrySubentity>
               <cbc:CountrySubentityCode><?php echo $CustomerDeptoCode; ?></cbc:CountrySubentityCode>
               <cac:AddressLine>
                  <cbc:Line><?php echo $CustomerAddress; ?></cbc:Line>
               </cac:AddressLine>
               <cac:Country>
                  <cbc:IdentificationCode>CO</cbc:IdentificationCode>
                  <cbc:Name languageID="es">Colombia</cbc:Name>
               </cac:Country>
            </cac:Address>
         </cac:PhysicalLocation>

         <cac:PartyTaxScheme>
            <cbc:RegistrationName><?php echo $CustomerName; ?></cbc:RegistrationName>
            <cbc:CompanyID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeName=<?php echo $CustomerIdCode; ?>><?php echo $CustomerNIT; ?></cbc:CompanyID>

            <cac:TaxScheme>
               <cbc:ID>ZY</cbc:ID>
               <cbc:Name>No Causa</cbc:Name>
            </cac:TaxScheme>

         </cac:PartyTaxScheme>

         <cac:PartyLegalEntity>
            <cbc:RegistrationName><?php echo $CustomerName; ?></cbc:RegistrationName>
            <cbc:CompanyID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="3" schemeName=<?php echo $CustomerIdCode; ?>><?php echo $CustomerNIT; ?></cbc:CompanyID>
         </cac:PartyLegalEntity>
      </cac:Party>
   </cac:AccountingCustomerParty>
   

   <cac:PaymentMeans>
      <cbc:ID><?php echo $PaymentMeansID; ?></cbc:ID>
      <cbc:PaymentMeansCode><?php echo $PaymentMeansCode; ?></cbc:PaymentMeansCode>
   </cac:PaymentMeans>


   <cac:TaxTotal>
      

      <cac:TaxSubtotal>
          <cbc:TaxableAmount currencyID="COP"><?php echo $TaxableAmount; ?></cbc:TaxableAmount>
         <cac:TaxCategory>
            <cbc:Percent><?php echo $percent; ?></cbc:Percent>
            <cac:TaxScheme>
               <cbc:ID>01</cbc:ID>
               <cbc:Name>IVA</cbc:Name>
            </cac:TaxScheme>
         </cac:TaxCategory>
         <cbc:TaxAmount currencyID="COP"><?php echo $TaxAmount; ?></cbc:TaxAmount>
      </cac:TaxSubtotal>


   <cac:LegalMonetaryTotal>
      <cbc:LineExtensionAmount currencyID="COP">><?php echo $LineExtensionAmount; ?></cbc:LineExtensionAmount>
      <cbc:AllowanceTotalAmount currencyID="COP">><?php echo $AllowanceTotalAmount; ?></cbc:AllowanceTotalAmount>
      <cbc:TaxExclusiveAmount currencyID="COP">><?php echo $TaxExclusiveAmount; ?></cbc:TaxExclusiveAmount>
      <cbc:TaxInclusiveAmount currencyID="COP">><?php echo $TaxInclusiveAmount; ?></cbc:TaxInclusiveAmount>
      <cbc:PayableAmount currencyID="COP"><?php echo $PayableAmount; ?></cbc:PayableAmount>
   </cac:LegalMonetaryTotal>

   <cac:InvoiceLine>
      <cbc:ID><?php echo $LineID; ?></cbc:ID>
      <cbc:InvoicedQuantity unitCode="EA"><?php echo $LineQty; ?></cbc:InvoicedQuantity>
      <cac:AllowanceCharge>
         <cbc:ID><?php echo $AllowanceChargeID; ?></cbc:ID>
         <cbc:ChargeIndicator><?php echo $ChargeIndicator; ?></cbc:ChargeIndicator>
         <cbc:BaseAmount currencyID="COP"><?php echo $LineBaseAmount; ?></cbc:BaseAmount>
         <cbc:MultiplierFactorNumeric><?php echo $AllowancePercentage; ?></cbc:MultiplierFactorNumeric>
         <cbc:Amount currencyID="COP"><?php echo $LineAllowanceAmount; ?></cbc:Amount>
      </cac:AllowanceCharge>

      <cbc:LineExtensionAmount currencyID="COP"><?php echo $LineTotal; ?></cbc:LineExtensionAmount>

      <cac:TaxTotal>
         
         <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="COP"><?php echo $LineTotal; ?></cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="COP"><?php echo $LineTax; ?></cbc:TaxAmount>
            <cac:TaxCategory>
               <cbc:Percent><?php echo $LineTaxPercentage; ?></cbc:Percent>
               <cac:TaxScheme>
                  <cbc:ID>01</cbc:ID>
                  <cbc:Name>IVA</cbc:Name>
               </cac:TaxScheme>
            </cac:TaxCategory>
         </cac:TaxSubtotal>
      <cbc:TaxAmount currencyID="COP"><?php echo $LineTax; ?></cbc:TaxAmount>
      </cac:TaxTotal>

      <cac:Item>
         <cbc:Description><?php echo $LineItemName; ?></cbc:Description>
      </cac:Item>

      <cac:Price>
         <cbc:PriceAmount currencyID="COP"><?php echo $LineTotal; ?></cbc:PriceAmount>
         <cbc:BaseQuantity unitCode="EA"><?php echo $LineQty; ?></cbc:BaseQuantity>
      </cac:Price>
   </cac:InvoiceLine>
   

</Invoice>