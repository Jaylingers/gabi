function calculateAge() {
    const birthday = document.getElementById('birthday').value;
    if (birthday) {
        const birthDate = new Date(birthday);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        document.getElementById('age').value = age;
    }
}

function handleMaritalStatus() {
    const maritalStatus = document.getElementById('marital_status').value;
    const partnerInfo = document.getElementById('partner_info');

    if (maritalStatus === 'Married' || maritalStatus === 'Lived in Partner') {
        partnerInfo.style.display = 'block';
    } else if (maritalStatus === 'Widower/Widow' || maritalStatus === 'Single Parent') {
        partnerInfo.style.display = 'block';
        document.getElementById('partner_name').style.display = 'none';
    } else {
        partnerInfo.style.display = 'none';
    }
}

function handleSourceOfIncome() {
    const sourceOfIncome = document.getElementById('source_of_income').value;
    const privateInfo = document.getElementById('private_info');
    const governmentInfo = document.getElementById('government_info');
    const driverInfo = document.getElementById('driver_info');
    const businessInfo = document.getElementById('business_info');

    privateInfo.style.display = 'none';
    governmentInfo.style.display = 'none';
    driverInfo.style.display = 'none';
    businessInfo.style.display = 'none';

    if (sourceOfIncome === 'Private') {
        privateInfo.style.display = 'block';
    } else if (sourceOfIncome === 'Government') {
        governmentInfo.style.display = 'block';
    } else if (sourceOfIncome === 'Driver') {
        driverInfo.style.display = 'block';
    } else if (sourceOfIncome === 'Business') {
        businessInfo.style.display = 'block';
    }
}
