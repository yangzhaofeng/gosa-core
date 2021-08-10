<?php
$class_mapping= array(
                "msg_dialog" => "include/class_msg_dialog.inc",
                "tabs" => "include/class_tabs.inc",
                "jsonRPC" => "include/class_jsonRPC.inc",
                "log" => "include/class_log.inc",
                "ldapMultiplexer" => "include/class_ldapMultiplexer.inc",
                "plugin" => "include/class_plugin.inc",
                "parseXml" => "include/functions_helpviewer.inc",
                "passwordMethodMd5" => "include/password-methods/class_password-methods-md5.inc",
                "passwordMethodsasl" => "include/password-methods/class_password-methods-sasl.inc",
                "passwordMethodRemote" => "include/password-methods/class_password-methods-remote.inc",
                "passwordMethodClear" => "include/password-methods/class_password-methods-clear.inc",
                "passwordMethodsmd5" => "include/password-methods/class_password-methods-smd5.inc",
                "passwordMethod" => "include/password-methods/class_password-methods.inc",
                "passwordMethodssha" => "include/password-methods/class_password-methods-ssha.inc",
                "passwordMethodCrypt" => "include/password-methods/class_password-methods-crypt.inc",
                "passwordMethodsha" => "include/password-methods/class_password-methods-sha.inc",
                "SnapShotDialog" => "include/class_SnapShotDialog.inc",
                "session" => "include/class_session.inc",
                "filterLDAP" => "include/class_filterLDAP.inc",
                "userFilterEditor" => "include/class_userFilterEditor.inc",
                "remoteObject" => "include/class_remoteObject.inc",
                "GOsaRegistration" => "include/class_GOsaRegistration.inc",
                "userFilter" => "include/class_userFilter.inc",
                "csvExporter" => "include/exporter/class_csvExporter.inc",
                "pdfExporter" => "include/exporter/class_pdfExporter.inc",
                "baseSelector" => "include/class_baseSelector.inc",
                "SnapshotHandler" => "include/class_SnapshotHandler.inc",
                "config" => "include/class_config.inc",
                "configRegistry" => "include/class_configRegistry.inc",
                "gosaProperty" => "include/class_configRegistry.inc",
                "Print_a_class" => "include/functions_debug.inc",
                "departmentSortIterator" => "include/class_departmentSortIterator.inc",
                "pChartInclude" => "include/class_pChartInclude.inc",
                "all" => "include/class_core.inc",
                "core" => "include/class_core.inc",
                "pluglist" => "include/class_pluglist.inc",
                "Socket_Client" => "include/class_socketClient.inc",
                "listingSortIterator" => "include/class_listingSortIterator.inc",
                "releaseSelector" => "include/class_releaseSelector.inc",
                "stats" => "include/class_stats.inc",
                "certificate" => "include/class_certificate.inc",
                "ItemSelector" => "include/class_ItemSelector.inc",
                "pathNavigator" => "include/class_pathNavigator.inc",
                "userinfo" => "include/class_userinfo.inc",
                "acl" => "include/class_acl.inc",
                "filterNOACL" => "include/class_filterNOACL.inc",
                "CopyPasteHandler" => "include/class_CopyPasteHandler.inc",
                "multi_plug" => "include/class_multi_plug.inc",
                "tests" => "include/utils/class_tests.inc",
                "xml" => "include/utils/class_xml.inc",
                "writeexcel_formula" => "include/utils/excel/class.writeexcel_formula.inc.php",
                "writeexcel_worksheet" => "include/utils/excel/class.writeexcel_worksheet.inc.php",
                "writeexcel_workbook" => "include/utils/excel/class.writeexcel_workbook.inc.php",
                "writeexcel_format" => "include/utils/excel/class.writeexcel_format.inc.php",
                "writeexcel_olewriter" => "include/utils/excel/class.writeexcel_olewriter.inc.php",
                "writeexcel_biffwriter" => "include/utils/excel/class.writeexcel_biffwriter.inc.php",
                "timezone" => "include/utils/class_timezone.inc",
                "msgPool" => "include/utils/class_msgPool.inc",
                "filter" => "include/class_filter.inc",
                "sortableListing" => "include/class_sortableListing.inc",
                "management" => "include/class_management.inc",
                "listing" => "include/class_listing.inc",
                "LDAP" => "include/class_ldap.inc",
                "Step_Schema" => "setup/class_setupStep_Schema.inc",
                "Step_Ldap" => "setup/class_setupStep_Ldap.inc",
                "Step_Checks" => "setup/class_setupStep_Checks.inc",
                "Step_Finish" => "setup/class_setupStep_Finish.inc",
                "Step_Migrate" => "setup/class_setupStep_Migrate.inc",
                "Step_License" => "setup/class_setupStep_License.inc",
                "Step_Language" => "setup/class_setupStep_Language.inc",
                "setup" => "setup/class_setup.inc",
                "Step_Feedback" => "setup/class_setupStep_Feedback.inc",
                "setup_step" => "setup/class_setupStep.inc",
                "Step_Welcome" => "setup/class_setupStep_Welcome.inc",
                "filterSYSTEMS" => "plugins/admin/systems/class_filterSYSTEMS.inc",
                "termDNS" => "plugins/admin/systems/class_termDNS.inc",
                "gospamserver" => "plugins/admin/systems/services/spam/class_goSpamServer.inc",
                "goSpamServerRule" => "plugins/admin/systems/services/spam/class_goSpamServerRule.inc",
                "goService" => "plugins/admin/systems/services/class_goService.inc",
                "goMailServer" => "plugins/admin/systems/services/mail/class_goMailServer.inc",
                "goImapServer" => "plugins/admin/systems/services/imap/class_goImapServer.inc",
                "govirusserver" => "plugins/admin/systems/services/virus/class_goVirusServer.inc",
                "systemManagement" => "plugins/admin/systems/class_systemManagement.inc",
                "servgeneric" => "plugins/admin/systems/class_servGeneric.inc",
                "componentGeneric" => "plugins/admin/systems/class_componentGeneric.inc",
                "filterServerService" => "plugins/admin/systems/class_filterServerService.inc",
                "ServerService" => "plugins/admin/systems/class_serverService.inc",
                "componenttabs" => "plugins/admin/systems/tabs_component.inc",
                "filterOPSIHOSTS" => "plugins/admin/systems/class_filterOPSIHOSTS.inc",
                "migrate_serverRDN" => "plugins/admin/systems/migration/class_migrate_serverRDN.inc",
                "migrate_componentRDN" => "plugins/admin/systems/migration/class_migrate_componentRDN.inc",
                "migrate_systemRDN" => "plugins/admin/systems/migration/class_migrate_systemRDN.inc",
                "servtabs" => "plugins/admin/systems/tabs_server.inc",
                "ArpNewDeviceTabs" => "plugins/admin/systems/tabs_arpnewdevice.inc",
                "systemSelect" => "plugins/admin/systems/systemSelect/class_systemSelect.inc",
                "filterGroupLDAP" => "plugins/admin/groups/class_filterGroupLDAP.inc",
                "userSelect" => "plugins/admin/groups/userSelect/class_userSelect.inc",
                "singleUserSelect" => "plugins/admin/groups/singleUserSelect/class_singleUserSelect.inc",
                "userGroupSelect" => "plugins/admin/groups/userGroupSelect/class_userGroupSelect.inc",
                "group" => "plugins/admin/groups/class_group.inc",
                "mailgroup" => "plugins/admin/groups/mail/class_groupMail.inc",
                "grouptabs" => "plugins/admin/groups/tabs_group.inc",
                "groupManagement" => "plugins/admin/groups/class_groupManagement.inc",
                "migrate_groupRDN" => "plugins/admin/groups/migration/class_migrate_groupRDN.inc",
                "ogrouptabs" => "plugins/admin/ogroups/tabs_ogroups.inc",
                "_available" => "plugins/admin/ogroups/tabs_ogroups.inc",
                "ogroupManagement" => "plugins/admin/ogroups/class_ogroupManagement.inc",
                "mailogroup" => "plugins/admin/ogroups/mail/class_mailogroup.inc",
                "migrate_ogroupRDN" => "plugins/admin/ogroups/migration/class_migrate_ogroupRDN.inc",
                "ogroup" => "plugins/admin/ogroups/class_ogroup.inc",
                "filterLDAPDepartmentBlacklist" => "plugins/admin/ogroups/objectSelect/class_filterLDAPDepartmentBlacklist.inc",
                "objectSelect" => "plugins/admin/ogroups/objectSelect/class_objectSelect.inc",
                "country" => "plugins/admin/departments/class_countryGeneric.inc",
                "deptabs" => "plugins/admin/departments/tabs_department.inc",
                "department" => "plugins/admin/departments/class_department.inc",
                "domain" => "plugins/admin/departments/class_domain.inc",
                "locality" => "plugins/admin/departments/class_localityGeneric.inc",
                "departmentManagement" => "plugins/admin/departments/class_departmentManagement.inc",
                "dcObject" => "plugins/admin/departments/class_dcObject.inc",
                "filterDEPARTMENT" => "plugins/admin/departments/class_filterDEPARTMENT.inc",
                "organization" => "plugins/admin/departments/class_organizationGeneric.inc",
                "usertabs" => "plugins/admin/users/tabs_user.inc",
                "userManagement" => "plugins/admin/users/class_userManagement.inc",
                "migrate_userRDN" => "plugins/admin/users/migration/class_migrate_userRDN.inc",
                "filterACL" => "plugins/admin/acl/class_filterACL.inc",
                "aclrole" => "plugins/admin/acl/class_aclRole.inc",
                "aclroletab" => "plugins/admin/acl/tabs_acl_role.inc",
                "acltab" => "plugins/admin/acl/tabs_acl.inc",
                "aclManagement" => "plugins/admin/acl/class_aclManagement.inc",
                "migrate_aclRoleRDN" => "plugins/admin/acl/migration/class_migrate_aclRoleRDN.inc",
                "password" => "plugins/personal/password/class_password.inc",
                "filterLDAPBlacklist" => "plugins/personal/posix/groupSelect/class_filterLDAPBlacklist.inc",
                "groupSelect" => "plugins/personal/posix/groupSelect/class_groupSelect.inc",
                "trustSelect" => "plugins/personal/posix/trustSelect/class_trustSelect.inc",
                "trustModeDialog" => "plugins/personal/posix/trustModeDialog/class_trustModeDialog.inc",
                "posixAccount" => "plugins/personal/posix/class_posixAccount.inc",
                "mailAccount" => "plugins/personal/mail/class_mailAccount.inc",
                "mailMethod" => "plugins/personal/mail/class_mail-methods.inc",
                "mailAddressSelect" => "plugins/personal/mail/mailAddressSelect/class_mailAddressSelect.inc",
                "sieveManagement" => "plugins/personal/mail/sieve/class_sieveManagement.inc",
                "My_Tree" => "plugins/personal/mail/sieve/class_My_Tree.inc",
                "sieve_redirect" => "plugins/personal/mail/sieve/class_sieveElement_Redirect.inc",
                "sieve_comment" => "plugins/personal/mail/sieve/class_sieveElement_Comment.inc",
                "My_Parser" => "plugins/personal/mail/sieve/class_My_Parser.inc",
                "sieve_fileinto" => "plugins/personal/mail/sieve/class_sieveElement_Fileinto.inc",
                "sieve_keep" => "plugins/personal/mail/sieve/class_sieveElement_Keep.inc",
                "Scanner" => "plugins/personal/mail/sieve/class_scanner.inc",
                "sieve_if" => "plugins/personal/mail/sieve/class_sieveElement_If.inc",
                "sieve_elsif" => "plugins/personal/mail/sieve/class_sieveElement_Else_Elsif.inc",
                "sieve_else" => "plugins/personal/mail/sieve/class_sieveElement_Else_Elsif.inc",
                "My_Scanner" => "plugins/personal/mail/sieve/class_My_Scanner.inc",
                "sieve_block_end" => "plugins/personal/mail/sieve/class_sieveElement_Block_End.inc",
                "Parser" => "plugins/personal/mail/sieve/class_parser.inc",
                "sieve_block_start" => "plugins/personal/mail/sieve/class_sieveElement_Block_Start.inc",
                "Semantics" => "plugins/personal/mail/sieve/class_semantics.inc",
                "sieve_vacation" => "plugins/personal/mail/sieve/class_sieveElement_Vacation.inc",
                "sieve_stop" => "plugins/personal/mail/sieve/class_sieveElement_Stop.inc",
                "sieve" => "plugins/personal/mail/sieve/class_sieve.inc",
                "sieve_require" => "plugins/personal/mail/sieve/class_sieveElement_Require.inc",
                "Tree" => "plugins/personal/mail/sieve/class_tree.inc",
                "sieve_discard" => "plugins/personal/mail/sieve/class_sieveElement_Discard.inc",
                "sieve_reject" => "plugins/personal/mail/sieve/class_sieveElement_Reject.inc",
                "mailMethodCyrus" => "plugins/personal/mail/class_mail-methods-cyrus.inc",
                "mailMethodSendmailCyrus" => "plugins/personal/mail/class_mail-methods-sendmail-cyrus.inc",
                "MyAccountTabs" => "plugins/personal/myaccount/MyAccountTabs.inc",
                "MyAccount" => "plugins/personal/myaccount/class_MyAccount.inc",
                "user" => "plugins/personal/generic/class_user.inc",
                "infoPage" => "plugins/generic/infoPage/class_infoPage.inc",
                "statistics" => "plugins/generic/statistics/class_statistics.inc",
                "memoryUsageChart" => "plugins/generic/statistics/chartClasses/class_memoryUsageChart.inc",
                "categoryActionsOverTime" => "plugins/generic/statistics/chartClasses/class_categoryActionOverTime.inc",
                "objectCountChart" => "plugins/generic/statistics/chartClasses/class_objectCountChart.inc",
                "pieChart1" => "plugins/generic/statistics/chartClasses/class_pieChart1.inc",
                "durationTimeChart" => "plugins/generic/statistics/chartClasses/class_durationTimeChart.inc",
                "cpuLoadChart" => "plugins/generic/statistics/chartClasses/class_cpuLoadChart.inc",
                "passwordChangeChart" => "plugins/generic/statistics/chartClasses/class_passwordChangeChart.inc",
                "pieChart2" => "plugins/generic/statistics/chartClasses/class_pieChart2.inc",
                "renderTimeChart" => "plugins/generic/statistics/chartClasses/class_renderTimeChart.inc",
                "actionSelectChart" => "plugins/generic/statistics/chartClasses/class_actionSelectChart.inc",
                "statChart" => "plugins/generic/statistics/chartClasses/class_statChart.inc",
                "dbChannelStatus" => "plugins/generic/dashBoard/dbChannelStatus/class_dbChannelStatus.inc",
                "dbInformation" => "plugins/generic/dashBoard/dbInformation/class_dbInformation.inc",
                "RegistrationDialog" => "plugins/generic/dashBoard/Register/class_RegistrationDialog.inc",
                "rssReader" => "plugins/generic/dashBoard/class_rssReader.inc",
                "dbNotifications" => "plugins/generic/dashBoard/dbNotifications/class_dbNotifications.inc",
                "dbPluginStatus" => "plugins/generic/dashBoard/dbPluginStatus/class_dbPluginStatus.inc",
                "dashBoard" => "plugins/generic/dashBoard/class_dashBoard.inc",
                "ldifViewer" => "plugins/generic/references/class_ldifViewer.inc",
                "reference" => "plugins/generic/references/class_reference.inc",
                "aclResolver" => "plugins/generic/references/class_aclResolver.inc",
                "welcome" => "plugins/generic/welcome/class_welcome.inc",
                "DynamicLdapGroup" => "plugins/addons/dyngroup/class_DynamicLdapGroup.inc",
                "filterCONFIGPROPERTIES" => "plugins/addons/propertyEditor/class_filterProperties.inc",
                "propertyEditor" => "plugins/addons/propertyEditor/class_propertyEditor.inc",
                "commandVerifier" => "plugins/addons/propertyEditor/class_commandVerifier.inc",
                "migrateRDN" => "plugins/addons/propertyEditor/migration/class_migrateRDN.inc",
 );