
Name: app-two-factor-auth-extension
Epoch: 1
Version: 2.3.0
Release: 1%{dist}
Summary: Webconfig Two-Factor Authentication - Core
License: LGPLv3
Group: ClearOS/Libraries
Packager: eGloo
Vendor: Avantech
Source: app-two-factor-auth-extension-%{version}.tar.gz
Buildarch: noarch

%description
An extension that allows administrators to enforce two-factor authentication for Webconfig.

%package core
Summary: Webconfig Two-Factor Authentication - Core
Requires: app-base-core
Requires: app-openldap-directory-core
Requires: app-users

%description core
An extension that allows administrators to enforce two-factor authentication for Webconfig.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/two_factor_auth_extension
cp -r * %{buildroot}/usr/clearos/apps/two_factor_auth_extension/

install -D -m 0644 packaging/two_factor_auth.php %{buildroot}/var/clearos/openldap_directory/extensions/73_two_factor_auth.php

%post core
logger -p local6.notice -t installer 'app-two-factor-auth-extension-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/two_factor_auth_extension/deploy/install ] && /usr/clearos/apps/two_factor_auth_extension/deploy/install
fi

[ -x /usr/clearos/apps/two_factor_auth_extension/deploy/upgrade ] && /usr/clearos/apps/two_factor_auth_extension/deploy/upgrade

exit 0

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-two-factor-auth-extension-core - uninstalling'
    [ -x /usr/clearos/apps/two_factor_auth_extension/deploy/uninstall ] && /usr/clearos/apps/two_factor_auth_extension/deploy/uninstall
fi

exit 0

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/two_factor_auth_extension/packaging
%dir /usr/clearos/apps/two_factor_auth_extension
/usr/clearos/apps/two_factor_auth_extension/deploy
/usr/clearos/apps/two_factor_auth_extension/language
/usr/clearos/apps/two_factor_auth_extension/libraries
/var/clearos/openldap_directory/extensions/73_two_factor_auth.php
