import { useState } from 'react';
import { Package, MapPin, Clock, CheckCircle, Truck, AlertCircle } from 'lucide-react';

interface TrackingEvent {
  id: string;
  status: string;
  location: string;
  date: string;
  time: string;
  description: string;
  icon: 'package' | 'truck' | 'check' | 'alert';
}

interface PackageTracking {
  id: string;
  reference: string;
  carrier: string;
  sender: string;
  recipient: string;
  currentStatus: string;
  events: TrackingEvent[];
}

const mockTracking: PackageTracking = {
  id: '1',
  reference: 'COLIS-2024-1234',
  carrier: 'Chronopost',
  sender: 'Bureau Plus',
  recipient: 'IUT Villetaneuse - Bureau 203',
  currentStatus: 'En transit',
  events: [
    {
      id: '1',
      status: 'Livré',
      location: 'IUT Villetaneuse - Bureau 203',
      date: '2024-11-28',
      time: '14:30',
      description: 'Colis livré et signé',
      icon: 'check',
    },
    {
      id: '2',
      status: 'En cours de livraison',
      location: 'Centre de tri Villetaneuse',
      date: '2024-11-28',
      time: '10:15',
      description: 'Le colis est en cours de livraison',
      icon: 'truck',
    },
    {
      id: '3',
      status: 'Arrivé au centre de tri',
      location: 'Centre de tri Paris Nord',
      date: '2024-11-27',
      time: '18:45',
      description: 'Le colis est arrivé au centre de tri',
      icon: 'package',
    },
    {
      id: '4',
      status: 'En transit',
      location: 'Dépôt national',
      date: '2024-11-27',
      time: '08:00',
      description: 'Le colis a quitté le dépôt',
      icon: 'truck',
    },
  ],
};

export default function TrackingPage() {
  const [trackingNumber, setTrackingNumber] = useState('');
  const [showTracking, setShowTracking] = useState(true);

  const getIcon = (iconType: TrackingEvent['icon']) => {
    switch (iconType) {
      case 'check':
        return CheckCircle;
      case 'truck':
        return Truck;
      case 'alert':
        return AlertCircle;
      default:
        return Package;
    }
  };

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-[#1e3a5f] mb-2">Suivi de Colis</h1>
        <p className="text-gray-600">Suivez vos colis en temps réel</p>
      </div>

      <div className="bg-white rounded-lg shadow p-6 mb-6">
        <div className="flex gap-4">
          <input
            type="text"
            placeholder="Entrez un numéro de suivi..."
            value={trackingNumber}
            onChange={(e) => setTrackingNumber(e.target.value)}
            className="flex-1 px-4 py-2 border border-gray-300 rounded"
          />
          <button
            onClick={() => setShowTracking(true)}
            className="bg-[#1e3a5f] text-white px-6 py-2 rounded hover:bg-[#2a4a7f] transition-colors"
          >
            Rechercher
          </button>
        </div>
      </div>

      {showTracking && (
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div className="lg:col-span-2">
            <div className="bg-white rounded-lg shadow p-6">
              <h2 className="mb-6">Historique du colis</h2>
              <div className="relative">
                <div className="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-200" />
                <div className="space-y-6">
                  {mockTracking.events.map((event, index) => {
                    const Icon = getIcon(event.icon);
                    const isLatest = index === 0;
                    return (
                      <div key={event.id} className="relative flex gap-4">
                        <div
                          className={`relative z-10 flex items-center justify-center w-12 h-12 rounded-full ${
                            isLatest ? 'bg-green-100' : 'bg-gray-100'
                          }`}
                        >
                          <Icon
                            className={`w-6 h-6 ${
                              isLatest ? 'text-green-600' : 'text-gray-400'
                            }`}
                          />
                        </div>
                        <div className="flex-1 pb-6">
                          <div className="flex items-start justify-between mb-2">
                            <h3
                              className={isLatest ? 'text-green-600' : 'text-gray-900'}
                            >
                              {event.status}
                            </h3>
                            <div className="text-gray-500 text-sm text-right">
                              <div>{new Date(event.date).toLocaleDateString('fr-FR')}</div>
                              <div>{event.time}</div>
                            </div>
                          </div>
                          <div className="flex items-center gap-2 text-gray-600 mb-1">
                            <MapPin className="w-4 h-4" />
                            <span>{event.location}</span>
                          </div>
                          <p className="text-gray-600">{event.description}</p>
                        </div>
                      </div>
                    );
                  })}
                </div>
              </div>
            </div>
          </div>

          <div className="space-y-6">
            <div className="bg-white rounded-lg shadow p-6">
              <h2 className="mb-4">Informations du colis</h2>
              <div className="space-y-4">
                <div>
                  <div className="text-gray-600 text-sm mb-1">Référence</div>
                  <div className="text-gray-900">{mockTracking.reference}</div>
                </div>
                <div>
                  <div className="text-gray-600 text-sm mb-1">Transporteur</div>
                  <div className="text-gray-900">{mockTracking.carrier}</div>
                </div>
                <div>
                  <div className="text-gray-600 text-sm mb-1">Expéditeur</div>
                  <div className="text-gray-900">{mockTracking.sender}</div>
                </div>
                <div>
                  <div className="text-gray-600 text-sm mb-1">Destinataire</div>
                  <div className="text-gray-900">{mockTracking.recipient}</div>
                </div>
                <div>
                  <div className="text-gray-600 text-sm mb-1">Statut actuel</div>
                  <div className="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-800 rounded-full">
                    <Clock className="w-4 h-4" />
                    {mockTracking.currentStatus}
                  </div>
                </div>
              </div>
            </div>

            <div className="bg-blue-50 rounded-lg p-6 border border-blue-200">
              <div className="flex items-start gap-3">
                <Package className="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" />
                <div>
                  <h3 className="text-blue-900 mb-2">Livraison prévue</h3>
                  <p className="text-blue-700">
                    Votre colis sera livré aujourd'hui avant 17h00
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}

      <div className="mt-8 bg-white rounded-lg shadow p-6">
        <h2 className="mb-4">Colis récents</h2>
        <div className="space-y-3">
          {[
            { ref: 'COLIS-2024-1234', status: 'Livré', date: "Aujourd'hui" },
            { ref: 'COLIS-2024-1233', status: 'En transit', date: 'Hier' },
            { ref: 'COLIS-2024-1232', status: 'En attente', date: 'Il y a 2 jours' },
          ].map((pkg) => (
            <div
              key={pkg.ref}
              className="flex items-center justify-between p-4 bg-gray-50 rounded hover:bg-gray-100 cursor-pointer"
            >
              <div className="flex items-center gap-3">
                <Package className="w-5 h-5 text-gray-400" />
                <div>
                  <div className="text-gray-900">{pkg.ref}</div>
                  <div className="text-gray-500 text-sm">{pkg.date}</div>
                </div>
              </div>
              <span
                className={`px-3 py-1 rounded-full text-sm ${
                  pkg.status === 'Livré'
                    ? 'bg-green-100 text-green-800'
                    : pkg.status === 'En transit'
                    ? 'bg-blue-100 text-blue-800'
                    : 'bg-amber-100 text-amber-800'
                }`}
              >
                {pkg.status}
              </span>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
