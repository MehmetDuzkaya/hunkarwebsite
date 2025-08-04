document.addEventListener('DOMContentLoaded', function() {
  const langSwitcher = document.getElementById('lang-switcher');
  
  if (!langSwitcher) {
    console.warn('Language switcher not found');
    return;
  }

  const defaultLang = localStorage.getItem('lang') || 'tr';
  langSwitcher.value = defaultLang;
  loadLanguage(defaultLang);

  langSwitcher.addEventListener('change', function() {
    const selectedLang = this.value;
    localStorage.setItem('lang', selectedLang);
    loadLanguage(selectedLang);
  });

  function loadLanguage(lang) {
    fetch(`lang/${lang}.json`)
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        // Tüm data-key attribute'larına sahip elementleri bul
        document.querySelectorAll('[data-key]').forEach(el => {
          const key = el.getAttribute('data-key');
          if (data[key]) {
            if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
              el.placeholder = data[key];
            } else if (el.tagName === 'IMG') {
              el.alt = data[key];
            } else if (el.tagName === 'OPTION') {
              el.textContent = data[key];
            } else {
              el.textContent = data[key];
            }
          }
        });

        // Sayfa başlığını güncelle
        const titleElement = document.querySelector('title[data-key]');
        if (titleElement) {
          const titleKey = titleElement.getAttribute('data-key');
          if (data[titleKey]) {
            document.title = data[titleKey];
          }
        } else if (data['pageTitle']) {
          document.title = data['pageTitle'];
        }

        // Meta description'ı güncelle
        const metaDesc = document.querySelector('meta[name="description"]');
        if (metaDesc && data['pageDescription']) {
          metaDesc.setAttribute('content', data['pageDescription']);
        }

        // Select elementlerindeki option'ları güncelle
        document.querySelectorAll('select option[data-key]').forEach(option => {
          const key = option.getAttribute('data-key');
          if (data[key]) {
            option.textContent = data[key];
          }
        });

        console.log(`Language changed to: ${lang}`);
      })
      .catch(error => {
        console.error('Error loading language file:', error);
        // Hata durumunda varsayılan dil olan Türkçe'ye geri dön
        if (lang !== 'tr') {
          localStorage.setItem('lang', 'tr');
          langSwitcher.value = 'tr';
          loadLanguage('tr');
        }
      });
  }
});