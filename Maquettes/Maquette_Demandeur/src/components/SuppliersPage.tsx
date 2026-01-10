import { Phone, Mail, MapPin, FileText, Star } from 'lucide-react';

interface Supplier {
  id: string;
  name: string;
  category: string;
  rating: number;
  phone: string;
  email: string;
  address: string;
  specialties: string[];
  hasCatalog: boolean;
}

const mockSuppliers: Supplier[] = [
  {
    id: '1',
    name: 'Bureau Plus',
    category: 'Fournitures de bureau',
    rating: 4.5,
    phone: '01 48 26 30 40',
    email: 'contact@bureauplus.fr',
    address: '15 Rue de la République, 93430 Villetaneuse',
    specialties: ['Papeterie', 'Mobilier', 'Consommables'],
    hasCatalog: true,
  },
  {
    id: '2',
    name: 'TechSupply',
    category: 'Matériel informatique',
    rating: 4.8,
    phone: '01 48 26 31 50',
    email: 'ventes@techsupply.fr',
    address: '28 Avenue Jean Jaurès, 93300 Aubervilliers',
    specialties: ['Ordinateurs', 'Périphériques', 'Logiciels', 'Réseau'],
    hasCatalog: true,
  },
  {
    id: '3',
    name: 'Office Depot',
    category: 'Fournitures de bureau',
    rating: 4.2,
    phone: '01 48 26 32 60',
    email: 'pro@officedepot.fr',
    address: '45 Boulevard de la Liberté, 93200 Saint-Denis',
    specialties: ['Fournitures', 'Mobilier', 'Services impression'],
    hasCatalog: true,
  },
  {
    id: '4',
    name: 'LabEquip',
    category: 'Équipement de laboratoire',
    rating: 4.6,
    phone: '01 48 26 33 70',
    email: 'contact@labequip.fr',
    address: '12 Rue des Sciences, 93430 Villetaneuse',
    specialties: ['Matériel scientifique', 'Consommables labo', 'Chimie'],
    hasCatalog: false,
  },
];

export default function SuppliersPage() {
  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-[#1e3a5f] mb-2">Liste des Fournisseurs</h1>
        <p className="text-gray-600">Consultez nos fournisseurs référencés</p>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {mockSuppliers.map((supplier) => (
          <div key={supplier.id} className="bg-white rounded-lg shadow p-6">
            <div className="flex items-start justify-between mb-4">
              <div>
                <h2 className="text-[#1e3a5f] mb-1">{supplier.name}</h2>
                <p className="text-gray-600">{supplier.category}</p>
              </div>
              <div className="flex items-center gap-1">
                <Star className="w-5 h-5 text-amber-400 fill-amber-400" />
                <span className="text-gray-700">{supplier.rating}</span>
              </div>
            </div>

            <div className="space-y-3 mb-4">
              <div className="flex items-start gap-3">
                <Phone className="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" />
                <div>
                  <div className="text-gray-600 text-sm">Téléphone</div>
                  <a href={`tel:${supplier.phone}`} className="text-[#1e3a5f] hover:underline">
                    {supplier.phone}
                  </a>
                </div>
              </div>
              <div className="flex items-start gap-3">
                <Mail className="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" />
                <div>
                  <div className="text-gray-600 text-sm">Email</div>
                  <a href={`mailto:${supplier.email}`} className="text-[#1e3a5f] hover:underline">
                    {supplier.email}
                  </a>
                </div>
              </div>
              <div className="flex items-start gap-3">
                <MapPin className="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" />
                <div>
                  <div className="text-gray-600 text-sm">Adresse</div>
                  <p className="text-gray-700">{supplier.address}</p>
                </div>
              </div>
            </div>

            <div className="mb-4">
              <div className="text-gray-600 text-sm mb-2">Spécialités</div>
              <div className="flex flex-wrap gap-2">
                {supplier.specialties.map((specialty) => (
                  <span
                    key={specialty}
                    className="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm"
                  >
                    {specialty}
                  </span>
                ))}
              </div>
            </div>

            {supplier.hasCatalog && (
              <button className="w-full flex items-center justify-center gap-2 px-4 py-2 border border-[#1e3a5f] text-[#1e3a5f] rounded hover:bg-gray-50 transition-colors">
                <FileText className="w-5 h-5" />
                Consulter le catalogue
              </button>
            )}
          </div>
        ))}
      </div>

      <div className="mt-8 bg-blue-50 rounded-lg p-6 border border-blue-200">
        <h2 className="text-[#1e3a5f] mb-2">Besoin d'un nouveau fournisseur ?</h2>
        <p className="text-gray-700 mb-4">
          Si vous souhaitez ajouter un nouveau fournisseur à la liste, veuillez contacter le
          service des achats.
        </p>
        <button className="bg-[#1e3a5f] text-white px-6 py-2 rounded hover:bg-[#2a4a7f] transition-colors">
          Contacter le service des achats
        </button>
      </div>
    </div>
  );
}
