import type { APIRoute } from 'astro';
import { getAllProduits } from '../data/produits';

export const GET: APIRoute = async ({ site }) => {
  const baseUrl = site?.href || 'https://mmbagrofarm.fr';
  const produits = getAllProduits();

  const pages = [
    '',
    '/produits',
    '/a-propos',
    '/contact',
    '/faq'
  ];

  const sitemap = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  ${pages.map(page => `
  <url>
    <loc>${baseUrl}${page}</loc>
    <lastmod>${new Date().toISOString()}</lastmod>
    <changefreq>${page === '' ? 'weekly' : 'monthly'}</changefreq>
    <priority>${page === '' ? '1.0' : '0.8'}</priority>
  </url>`).join('')}
  ${produits.map(produit => `
  <url>
    <loc>${baseUrl}/produits/${produit.slug}</loc>
    <lastmod>${new Date().toISOString()}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>`).join('')}
</urlset>`;

  return new Response(sitemap, {
    headers: {
      'Content-Type': 'application/xml',
    },
  });
};
