import { useState } from 'react';
import { ScanLine, Camera, Package, MapPin, User, Clock, CheckCircle } from 'lucide-react';

export function Scanner() {
  const [scanMode, setScanMode] = useState<'barcode' | 'manual'>('barcode');
  const [scannedCode, setScannedCode] = useState('');
  const [packageInfo, setPackageInfo] = useState<any>(null);

  const handleScan = (code: string) => {
    setScannedCode(code);
    // Simuler la recherche d'un colis
    setTimeout(() => {
      setPackageInfo({
        id: code || 'CP2024-11-156',
        sender: 'Bureau Principal - Paris 13e',
        recipient: 'Marie Dupont',
        address: '99 Avenue Jean-Baptiste Clément, 93430 Villetaneuse',
        weight: '2.3 kg',
        status: 'En attente de livraison',
        date: '28/11/2025 - 08:30',
        type: 'Colis Standard',
      });
    }, 500);
  };

  const handleStatusUpdate = (newStatus: string) => {
    alert(`Statut mis à jour: ${newStatus}`);
  };

  return (
    <div className="max-w-5xl">
      <div className="mb-8">
        <h1 className="text-[#1a3a5c] mb-2">Scanner un colis</h1>
        <p className="text-gray-600">Scannez le code-barres ou entrez manuellement le numéro de suivi</p>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {/* Scanner Section */}
        <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
          <div className="flex gap-2 mb-6">
            <button
              onClick={() => setScanMode('barcode')}
              className={`flex-1 px-4 py-2 rounded transition-colors ${
                scanMode === 'barcode'
                  ? 'bg-[#1a3a5c] text-white'
                  : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
              }`}
            >
              <ScanLine className="w-4 h-4 inline mr-2" />
              Scanner
            </button>
            <button
              onClick={() => setScanMode('manual')}
              className={`flex-1 px-4 py-2 rounded transition-colors ${
                scanMode === 'manual'
                  ? 'bg-[#1a3a5c] text-white'
                  : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
              }`}
            >
              Saisie manuelle
            </button>
          </div>

          {scanMode === 'barcode' ? (
            <div className="space-y-4">
              <div className="bg-gray-900 rounded-lg aspect-video flex items-center justify-center relative overflow-hidden">
                <div className="absolute inset-0 bg-gradient-to-b from-transparent via-[#f4b942]/20 to-transparent animate-pulse"></div>
                <Camera className="w-16 h-16 text-white/50" />
                <div className="absolute inset-x-8 top-1/2 -translate-y-1/2 h-0.5 bg-red-500 shadow-lg shadow-red-500/50"></div>
              </div>
              <button
                onClick={() => handleScan('CP2024-11-156')}
                className="w-full bg-[#f4b942] hover:bg-[#e5a832] text-[#1a3a5c] py-3 rounded transition-colors"
              >
                Simuler un scan
              </button>
              <p className="text-center text-sm text-gray-600">
                Positionnez le code-barres devant la caméra
              </p>
            </div>
          ) : (
            <div className="space-y-4">
              <div>
                <label className="block text-sm text-gray-700 mb-2">Numéro de colis</label>
                <input
                  type="text"
                  value={scannedCode}
                  onChange={(e) => setScannedCode(e.target.value)}
                  placeholder="Ex: CP2024-11-156"
                  className="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#1a3a5c]"
                />
              </div>
              <button
                onClick={() => handleScan(scannedCode)}
                className="w-full bg-[#1a3a5c] hover:bg-[#2d5273] text-white py-3 rounded transition-colors"
              >
                Rechercher
              </button>
            </div>
          )}
        </div>

        {/* Package Info Section */}
        <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
          {packageInfo ? (
            <div className="space-y-6">
              <div className="flex items-start justify-between pb-4 border-b border-gray-200">
                <div>
                  <h2 className="text-[#1a3a5c] mb-1">{packageInfo.id}</h2>
                  <span className="inline-block px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm">
                    {packageInfo.status}
                  </span>
                </div>
                <Package className="w-8 h-8 text-[#1a3a5c]" />
              </div>

              <div className="space-y-4">
                <div className="flex items-start gap-3">
                  <User className="w-5 h-5 text-gray-400 mt-0.5" />
                  <div>
                    <p className="text-sm text-gray-600">Destinataire</p>
                    <p className="text-[#1a3a5c]">{packageInfo.recipient}</p>
                  </div>
                </div>

                <div className="flex items-start gap-3">
                  <MapPin className="w-5 h-5 text-gray-400 mt-0.5" />
                  <div>
                    <p className="text-sm text-gray-600">Adresse de livraison</p>
                    <p className="text-[#1a3a5c]">{packageInfo.address}</p>
                  </div>
                </div>

                <div className="flex items-start gap-3">
                  <Clock className="w-5 h-5 text-gray-400 mt-0.5" />
                  <div>
                    <p className="text-sm text-gray-600">Date de réception</p>
                    <p className="text-[#1a3a5c]">{packageInfo.date}</p>
                  </div>
                </div>

                <div className="grid grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                  <div>
                    <p className="text-sm text-gray-600">Type</p>
                    <p className="text-[#1a3a5c]">{packageInfo.type}</p>
                  </div>
                  <div>
                    <p className="text-sm text-gray-600">Poids</p>
                    <p className="text-[#1a3a5c]">{packageInfo.weight}</p>
                  </div>
                </div>
              </div>

              <div className="pt-6 border-t border-gray-200 space-y-3">
                <p className="text-sm text-gray-700">Actions rapides</p>
                <div className="grid grid-cols-2 gap-3">
                  <button
                    onClick={() => handleStatusUpdate('En cours de livraison')}
                    className="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded transition-colors text-sm"
                  >
                    En livraison
                  </button>
                  <button
                    onClick={() => handleStatusUpdate('Livré')}
                    className="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded transition-colors text-sm flex items-center justify-center gap-2"
                  >
                    <CheckCircle className="w-4 h-4" />
                    Livré
                  </button>
                </div>
                <button className="w-full px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors text-sm">
                  Signaler un problème
                </button>
              </div>
            </div>
          ) : (
            <div className="flex flex-col items-center justify-center py-12 text-center">
              <ScanLine className="w-16 h-16 text-gray-300 mb-4" />
              <p className="text-gray-500">Scannez un colis pour voir les détails</p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}
