import { useState } from 'react';
import { Package, User, MapPin, Weight, DollarSign, Printer } from 'lucide-react';

export function NewShipment() {
  const [formData, setFormData] = useState({
    recipientName: '',
    recipientPhone: '',
    recipientAddress: '',
    recipientCity: '',
    recipientPostal: '',
    weight: '',
    length: '',
    width: '',
    height: '',
    type: 'standard',
    insurance: false,
  });

  const [estimatedPrice, setEstimatedPrice] = useState<number | null>(null);

  const calculatePrice = () => {
    const basePrice = formData.type === 'express' ? 12 : 6;
    const weightPrice = parseFloat(formData.weight || '0') * 2;
    const insurancePrice = formData.insurance ? 5 : 0;
    const total = basePrice + weightPrice + insurancePrice;
    setEstimatedPrice(total);
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    alert('Bon d\'expédition créé avec succès ! Numéro: CP2024-11-' + Math.floor(Math.random() * 1000));
  };

  return (
    <div className="max-w-5xl">
      <div className="mb-8">
        <h1 className="text-[#1a3a5c] mb-2">Nouvel envoi</h1>
        <p className="text-gray-600">Créer un nouveau bon d'expédition postal</p>
      </div>

      <form onSubmit={handleSubmit} className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Main Form */}
        <div className="lg:col-span-2 space-y-6">
          {/* Recipient Information */}
          <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div className="flex items-center gap-2 mb-6">
              <User className="w-5 h-5 text-[#1a3a5c]" />
              <h2 className="text-[#1a3a5c]">Informations destinataire</h2>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm text-gray-700 mb-2">Nom complet *</label>
                <input
                  type="text"
                  required
                  value={formData.recipientName}
                  onChange={(e) => setFormData({ ...formData, recipientName: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                  placeholder="Jean Dupont"
                />
              </div>
              <div>
                <label className="block text-sm text-gray-700 mb-2">Téléphone *</label>
                <input
                  type="tel"
                  required
                  value={formData.recipientPhone}
                  onChange={(e) => setFormData({ ...formData, recipientPhone: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                  placeholder="06 12 34 56 78"
                />
              </div>
              <div className="md:col-span-2">
                <label className="block text-sm text-gray-700 mb-2">Adresse *</label>
                <input
                  type="text"
                  required
                  value={formData.recipientAddress}
                  onChange={(e) => setFormData({ ...formData, recipientAddress: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                  placeholder="99 Avenue Jean-Baptiste Clément"
                />
              </div>
              <div>
                <label className="block text-sm text-gray-700 mb-2">Ville *</label>
                <input
                  type="text"
                  required
                  value={formData.recipientCity}
                  onChange={(e) => setFormData({ ...formData, recipientCity: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                  placeholder="Villetaneuse"
                />
              </div>
              <div>
                <label className="block text-sm text-gray-700 mb-2">Code postal *</label>
                <input
                  type="text"
                  required
                  value={formData.recipientPostal}
                  onChange={(e) => setFormData({ ...formData, recipientPostal: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                  placeholder="93430"
                />
              </div>
            </div>
          </div>

          {/* Package Details */}
          <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div className="flex items-center gap-2 mb-6">
              <Package className="w-5 h-5 text-[#1a3a5c]" />
              <h2 className="text-[#1a3a5c]">Détails du colis</h2>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm text-gray-700 mb-2">Type d'envoi *</label>
                <select
                  value={formData.type}
                  onChange={(e) => setFormData({ ...formData, type: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                >
                  <option value="standard">Standard (3-5 jours)</option>
                  <option value="express">Express (24h)</option>
                </select>
              </div>
              <div>
                <label className="block text-sm text-gray-700 mb-2">Poids (kg) *</label>
                <input
                  type="number"
                  step="0.1"
                  required
                  value={formData.weight}
                  onChange={(e) => setFormData({ ...formData, weight: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                  placeholder="2.5"
                />
              </div>
              <div>
                <label className="block text-sm text-gray-700 mb-2">Longueur (cm)</label>
                <input
                  type="number"
                  value={formData.length}
                  onChange={(e) => setFormData({ ...formData, length: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                  placeholder="30"
                />
              </div>
              <div>
                <label className="block text-sm text-gray-700 mb-2">Largeur (cm)</label>
                <input
                  type="number"
                  value={formData.width}
                  onChange={(e) => setFormData({ ...formData, width: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                  placeholder="20"
                />
              </div>
              <div>
                <label className="block text-sm text-gray-700 mb-2">Hauteur (cm)</label>
                <input
                  type="number"
                  value={formData.height}
                  onChange={(e) => setFormData({ ...formData, height: e.target.value })}
                  className="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                  placeholder="15"
                />
              </div>
            </div>

            <div className="mt-4 flex items-center gap-2">
              <input
                type="checkbox"
                id="insurance"
                checked={formData.insurance}
                onChange={(e) => setFormData({ ...formData, insurance: e.target.checked })}
                className="w-4 h-4 text-[#1a3a5c] border-gray-300 rounded focus:ring-[#1a3a5c]"
              />
              <label htmlFor="insurance" className="text-sm text-gray-700">
                Ajouter une assurance (+5€)
              </label>
            </div>
          </div>
        </div>

        {/* Summary */}
        <div className="lg:col-span-1">
          <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-8">
            <h2 className="text-[#1a3a5c] mb-6">Récapitulatif</h2>

            <div className="space-y-4 mb-6">
              <div className="flex justify-between text-sm">
                <span className="text-gray-600">Type d'envoi</span>
                <span className="text-[#1a3a5c]">
                  {formData.type === 'express' ? 'Express' : 'Standard'}
                </span>
              </div>
              <div className="flex justify-between text-sm">
                <span className="text-gray-600">Poids</span>
                <span className="text-[#1a3a5c]">{formData.weight || '0'} kg</span>
              </div>
              <div className="flex justify-between text-sm">
                <span className="text-gray-600">Assurance</span>
                <span className="text-[#1a3a5c]">{formData.insurance ? 'Oui' : 'Non'}</span>
              </div>
            </div>

            <button
              type="button"
              onClick={calculatePrice}
              className="w-full bg-gray-100 hover:bg-gray-200 text-[#1a3a5c] py-3 rounded transition-colors mb-4"
            >
              Calculer le prix
            </button>

            {estimatedPrice !== null && (
              <div className="bg-[#f4b942]/20 border-2 border-[#f4b942] rounded-lg p-4 mb-6">
                <div className="flex items-center justify-between">
                  <span className="text-gray-700">Prix estimé</span>
                  <span className="text-2xl text-[#1a3a5c]">{estimatedPrice.toFixed(2)}€</span>
                </div>
              </div>
            )}

            <div className="space-y-3">
              <button
                type="submit"
                className="w-full bg-[#1a3a5c] hover:bg-[#2d5273] text-white py-3 rounded transition-colors flex items-center justify-center gap-2"
              >
                <Package className="w-4 h-4" />
                Créer l'expédition
              </button>
              <button
                type="button"
                className="w-full bg-[#f4b942] hover:bg-[#e5a832] text-[#1a3a5c] py-3 rounded transition-colors flex items-center justify-center gap-2"
              >
                <Printer className="w-4 h-4" />
                Imprimer l'étiquette
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  );
}
