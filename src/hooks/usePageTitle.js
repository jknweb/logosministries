import { useEffect } from 'react';
import { site } from '../data/site';

// Sous WordPress, le titre est géré par wp_head() / add_theme_support('title-tag').
export default function usePageTitle(title, description) {
  useEffect(() => {
    document.title = title ? `${title} · ${site.name}` : `${site.name} · Église à Kinshasa-Ngaliema`;
    if (description) {
      document.querySelector('meta[name="description"]')?.setAttribute('content', description);
    }
  }, [title, description]);
}
